<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Achievement;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search    = trim($request->get('q'));
        $category  = $request->get('kategori', 'semua');
        $activeTag = $request->get('tag');

        // 1. Query Data Berita / Artikel (Tabel post)
        $postsQuery = Post::with(['author', 'tags'])
            ->whereIn('status', ['Publish', 'published']);

        if (!empty($search)) {
            $postsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (!empty($activeTag)) {
            $postsQuery->whereHas('tags', function ($q) use ($activeTag) {
                $q->where('post_tag_slug', $activeTag);
            });
        }

        // 2. Query Data Prestasi (Tabel achievement)
        $achievementsQuery = Achievement::query();
        if (!empty($search)) {
            $achievementsQuery->where(function ($q) use ($search) {
                $q->where('achievement_title', 'like', "%{$search}%")
                  ->orWhere('achievement_content', 'like', "%{$search}%");
            });
        }

        // 3. Transform & Combine Data Sesuai Kategori Dipilih
        if ($category === 'berita') {
            $combined = $postsQuery->latest('datetime_created')->get()->map(function ($post) {
                return (object)[
                    'type'             => 'berita',
                    'id'               => $post->post_id,
                    'title'            => $post->title,
                    'slug'             => $post->slug,
                    'content'          => $post->content,
                    'thumbnail'        => $post->thumbnail,
                    'datetime_created' => $post->datetime_created,
                    'total_views'      => $post->total_views,
                    'author'           => $post->author->first_name ?? 'Humas',
                    'tags'             => $post->tags,
                ];
            });
        } elseif ($category === 'prestasi') {
            $combined = $achievementsQuery->latest('datetime_created')->get()->map(function ($achieve) {
                return (object)[
                    'type'             => 'prestasi',
                    'id'               => $achieve->achievement_id,
                    'title'            => $achieve->achievement_title,
                    'slug'             => $achieve->achievement_slug,
                    'content'          => $achieve->achievement_content,
                    'thumbnail'        => null,
                    'datetime_created' => $achieve->datetime_created,
                    'total_views'      => 0,
                    'author'           => 'Humas',
                    'tags'             => collect(),
                ];
            });
        } else { // 'semua'
            $postItems = $postsQuery->get()->map(function ($post) {
                return (object)[
                    'type'             => 'berita',
                    'id'               => $post->post_id,
                    'title'            => $post->title,
                    'slug'             => $post->slug,
                    'content'          => $post->content,
                    'thumbnail'        => $post->thumbnail,
                    'datetime_created' => $post->datetime_created,
                    'total_views'      => $post->total_views,
                    'author'           => $post->author->first_name ?? 'Humas',
                    'tags'             => $post->tags,
                ];
            });

            $achieveItems = !empty($activeTag) ? collect() : $achievementsQuery->get()->map(function ($achieve) {
                return (object)[
                    'type'             => 'prestasi',
                    'id'               => $achieve->achievement_id,
                    'title'            => $achieve->achievement_title,
                    'slug'             => $achieve->achievement_slug,
                    'content'          => $achieve->achievement_content,
                    'thumbnail'        => null,
                    'datetime_created' => $achieve->datetime_created,
                    'total_views'      => 0,
                    'author'           => 'Humas',
                    'tags'             => collect(),
                ];
            });

            $combined = $postItems->concat($achieveItems)->sortByDesc('datetime_created')->values();
        }

        // 4. Paginasi Manual
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 12;
        $currentPageItems = $combined->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $posts = new LengthAwarePaginator(
            $currentPageItems,
            $combined->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        // 5. Data Sidebar & Statistik Total
        $tags = PostTag::withCount('posts')->get();
        $totalBerita = Post::whereIn('status', ['Publish', 'published'])->count();
        $totalPrestasi = Achievement::count();
        $totalSemua = $totalBerita + $totalPrestasi;

        return view('berita', compact(
            'posts',
            'tags',
            'category',
            'search',
            'activeTag',
            'totalBerita',
            'totalPrestasi',
            'totalSemua'
        ));
    }

    /**
     * Menampilkan detail artikel berita atau prestasi berdasarkan slug
     */
    public function show($slug)
    {
        // 1. Cari pada tabel Post (Berita)
        $post = Post::with(['author', 'tags'])
            ->where('slug', $slug)
            ->whereIn('status', ['Publish', 'published'])
            ->first();

        if ($post) {
            // Tambahkan hitungan pembaca
            $post->increment('total_views');

            $article = (object)[
                'type'             => 'berita',
                'id'               => $post->post_id,
                'title'            => $post->title,
                'slug'             => $post->slug,
                'content'          => $post->content,
                'thumbnail'        => $post->thumbnail,
                'datetime_created' => $post->datetime_created,
                'total_views'      => $post->total_views,
                'author'           => $post->author->first_name ?? 'Humas Maitreyawira',
                'tags'             => $post->tags,
            ];
        } else {
            // 2. Jika tidak ada di Post, cari di tabel Achievement (Prestasi)
            $achieve = Achievement::where('achievement_slug', $slug)->firstOrFail();

            $article = (object)[
                'type'             => 'prestasi',
                'id'               => $achieve->achievement_id,
                'title'            => $achieve->achievement_title,
                'slug'             => $achieve->achievement_slug,
                'content'          => $achieve->achievement_content,
                'thumbnail'        => null,
                'datetime_created' => $achieve->datetime_created,
                'total_views'      => 0,
                'author'           => 'Humas Maitreyawira',
                'tags'             => collect(),
            ];
        }

        // 3. Ambil Berita Terbaru untuk Sidebar
        $recentPosts = Post::whereIn('status', ['Publish', 'published'])
            ->where('slug', '!=', $slug)
            ->latest('datetime_created')
            ->take(5)
            ->get();

        $tags = PostTag::withCount('posts')->get();

        return view('berita-detail', compact('article', 'recentPosts', 'tags'));
    }
}
