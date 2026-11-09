<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\AppMenu;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $search    = trim($request->get('q'));
        $activeTag =$request->get('tag');

        // Query Data Berita / Artikel (Tabel post)
        $postsQuery = Post::with(['author', 'tags'])
            ->whereIn('status', ['Publish', 'published']);

        // Filter Pencarian Judul & Isi Teks
        if (!empty($search)) {$postsQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "\%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan Tag Berita
        if (!empty($activeTag)) {$postsQuery->whereHas('tags', function ($q) use ($activeTag) {
                $q->where('post_tag_slug',$activeTag);
            });
        }

        // Paginasi 12 Berita per Halaman
        $posts =$postsQuery->latest('datetime_created')->paginate(12)->withQueryString();

        // Data Sidebar & Menu Header
        $tags = PostTag::withCount('posts')->get();$menu = AppMenu::where('slug', 'berita')->first();

        return view('berita', compact(
            'posts',
            'tags',
            'search',
            'activeTag',
            'menu'
        ));
    }

    /**
     * Menampilkan detail artikel berita berdasarkan slug
     */
    public function show($slug)
    {
        // Cari Berita berdasarkan slug yang dipublish
        $post = Post::with(['author', 'tags'])
            ->where('slug', $slug)
            ->whereIn('status', ['Publish', 'published'])
            ->firstOrFail();

        // Tambahkan hitungan jumlah pembaca
        $post->increment('total_views');

        // Ambil 5 Berita Terbaru untuk Sidebar (Kecuali berita yang sedang dibuka)
        $recentPosts = Post::whereIn('status', ['Publish', 'published'])
            ->where('slug', '!=', $slug)
            ->latest('datetime_created')
            ->take(5)
            ->get();

        $tags = PostTag::withCount('posts')->get();

        return view('berita-detail', compact('post', 'recentPosts', 'tags'));
    }
}
