{{-- File: resources/views/berita.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Artikel | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS & Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-16 sm:py-20">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down" data-aos-duration="1000">
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <span class="text-amber-400">Berita & Informasi</span>
            </nav>

            <div class="max-w-3xl space-y-4">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                    Pusat Informasi & Kabar
                </span>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    Berita & Kegiatan Terbaru <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500">
                        Sekolah Maitreyawira Palembang
                    </span>
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Dapatkan kabar terkini seputar liputan kegiatan sekolah, pengumuman resmi, prestasi murid, serta artikel seputar dunia pendidikan.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- TAB FILTER KATEGORI UTAMA --}}
            <div class="flex flex-wrap items-center justify-between gap-4 mb-10 pb-4 border-b border-slate-200" data-aos="fade-up">
                <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0">
                    <a href="{{ route('berita.index', array_filter(['q' => $search])) }}"
                       class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition shrink-0 flex items-center gap-2 {{ empty($category) || $category === 'semua' ? 'bg-[#1b2a6b] text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                        <span>Semua Kabar</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] {{ empty($category) || $category === 'semua' ? 'bg-amber-400 text-[#1b2a6b]' : 'bg-slate-100 text-slate-500' }}">{{ $totalSemua }}</span>
                    </a>
                    <a href="{{ route('berita.index', array_filter(['kategori' => 'berita', 'q' => $search, 'tag' => $activeTag])) }}"
                       class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition shrink-0 flex items-center gap-2 {{ $category === 'berita' ? 'bg-[#1b2a6b] text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                        <span>📰 Berita & Artikel</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] {{ $category === 'berita' ? 'bg-amber-400 text-[#1b2a6b]' : 'bg-slate-100 text-slate-500' }}">{{ $totalBerita }}</span>
                    </a>
                    <a href="{{ route('berita.index', array_filter(['kategori' => 'prestasi', 'q' => $search])) }}"
                       class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition shrink-0 flex items-center gap-2 {{ $category === 'prestasi' ? 'bg-[#1b2a6b] text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                        <span>🏆 Prestasi & Pencapaian</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] {{ $category === 'prestasi' ? 'bg-amber-400 text-[#1b2a6b]' : 'bg-slate-100 text-slate-500' }}">{{ $totalPrestasi }}</span>
                    </a>
                </div>

                {{-- BADGE FILTER AKTIF --}}
                <div class="flex flex-wrap items-center gap-2">
                    @if(!empty($search))
                        <div class="flex items-center gap-2 bg-amber-50 text-amber-800 px-3 py-1.5 rounded-lg border border-amber-200 text-xs font-bold">
                            <span>🔍 {{ $search }}</span>
                            <a href="{{ route('berita.index', array_filter(['kategori' => $category !== 'semua' ? $category : null, 'tag' => $activeTag])) }}" class="text-rose-500 hover:text-rose-700 ml-1 font-extrabold">✕</a>
                        </div>
                    @endif

                    @if(!empty($activeTag))
                        <div class="flex items-center gap-2 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg border border-blue-200 text-xs font-bold">
                            <span>#{{ $activeTag }}</span>
                            <a href="{{ route('berita.index', array_filter(['kategori' => $category !== 'semua' ? $category : null, 'q' => $search])) }}" class="text-rose-500 hover:text-rose-700 ml-1 font-extrabold">✕</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-12 items-start">

                <!-- KONTEN UTAMA (8 Kolom) -->
                <main class="lg:col-span-8 space-y-6">

                    {{-- HEADER GRID --}}
                    <div class="flex flex-wrap items-center justify-between border-b border-slate-200 pb-3 gap-2" data-aos="fade-up">
                        <h3 class="text-xl font-black text-slate-900">
                            @if($category === 'prestasi')
                                Prestasi & Penghargaan
                            @elseif($category === 'berita')
                                Artikel & Warta Sekolah
                            @else
                                Semua Kabar & Informasi
                            @endif
                        </h3>
                        @if($posts->total() > 0)
                            <span class="text-xs text-slate-500 font-medium">
                                Halaman <span class="font-bold text-blue-600">{{ $posts->currentPage() }}</span> dari <span class="font-bold text-slate-700">{{ $posts->lastPage() }}</span> (Total {{ $posts->total() }} Data)
                            </span>
                        @else
                            <span class="text-xs text-slate-500 font-medium">Menampilkan kabar terbaru</span>
                        @endif
                    </div>

                    {{-- GRID DAFTAR BERITA & PRESTASI --}}
                    <div class="grid sm:grid-cols-2 gap-6">
                        @forelse($posts as $post)
                            @php
                                $isPrestasi = ($post->type === 'prestasi');
                                $thumb = $post->thumbnail;
                                $fileName = basename($thumb ?? '');

                                if ($isPrestasi) {
                                    $imgUrl = 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=600&q=80';
                                } elseif (!empty($fileName) && file_exists(public_path('uploads/post/' . $fileName))) {
                                    $imgUrl = asset('uploads/post/' . $fileName);
                                } elseif (!empty($fileName) && file_exists(public_path('storage/post/' . $fileName))) {
                                    $imgUrl = asset('storage/post/' . $fileName);
                                } else {
                                    $imgUrl = 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&w=600&q=80';
                                }
                            @endphp

                            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-md transition group flex flex-col justify-between"
                                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 100 }}">
                                <div class="space-y-4">
                                    <div class="h-48 bg-slate-200 overflow-hidden relative">
                                        <img src="{{ $imgUrl }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                                        @if($isPrestasi)
                                            <span class="absolute top-3 left-3 px-2.5 py-0.5 bg-amber-500 text-slate-900 font-black text-[10px] rounded-full uppercase tracking-wider shadow-xs">
                                                🏆 Prestasi
                                            </span>
                                        @elseif($post->tags->count() > 0)
                                            <span class="absolute top-3 left-3 px-2.5 py-0.5 bg-blue-600 text-white font-bold text-[10px] rounded-full uppercase tracking-wider shadow-xs">
                                                #{{ $post->tags->first()->post_tag_name }}
                                            </span>
                                        @else
                                            <span class="absolute top-3 left-3 px-2.5 py-0.5 bg-blue-600 text-white font-bold text-[10px] rounded-full uppercase tracking-wider shadow-xs">
                                                Berita
                                            </span>
                                        @endif
                                    </div>
                                    <div class="px-6 space-y-2">
                                        <div class="text-[11px] text-slate-400 font-medium flex items-center gap-2">
                                            <span>📅 {{ \Carbon\Carbon::parse($post->datetime_created)->translatedFormat('d M Y') }}</span>
                                            @if(!$isPrestasi)
                                                <span>•</span>
                                                <span>👁️ {{ $post->total_views ?? 0 }}</span>
                                            @endif
                                        </div>
                                        <h4 class="font-bold text-slate-900 text-base group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                            <a href="{{ route('berita.show', $post->slug) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <p class="text-slate-600 text-xs leading-relaxed line-clamp-2">
                                            {!! strip_tags($post->content) !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="p-6 pt-4 border-t border-slate-100">
                                    <a href="{{ route('berita.show', $post->slug) }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                                        <span>Lihat Detail</span>
                                        <span>→</span>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="sm:col-span-2 p-12 text-center text-slate-400 italic bg-white rounded-2xl border border-dashed border-slate-200">
                                Belum ada berita atau prestasi yang ditemukan.
                            </div>
                        @endforelse
                    </div>

                    {{-- NAVIGASI HALAMAN --}}
                    @if ($posts->hasPages())
                        <div class="flex items-center justify-between border-t border-slate-200 pt-6 mt-8" data-aos="fade-up">

                            {{-- Tombol Previous --}}
                            @if ($posts->onFirstPage())
                                <span class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-400 font-bold text-xs cursor-not-allowed flex items-center gap-1 select-none border border-slate-200/60">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    <span>Sebelumnya</span>
                                </span>
                            @else
                                <a href="{{ $posts->previousPageUrl() }}"
                                   class="px-4 py-2.5 rounded-xl bg-white border border-slate-200/80 text-slate-700 font-bold text-xs hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition flex items-center gap-1 shadow-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    <span>Sebelumnya</span>
                                </a>
                            @endif

                            {{-- Detail Informasi Halaman --}}
                            <div class="text-xs font-semibold text-slate-600 bg-white px-4 py-2 rounded-xl border border-slate-200/80 shadow-xs flex items-center gap-1.5">
                                <span>Halaman</span>
                                <span class="font-black text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100">
                                    {{ $posts->currentPage() }}
                                </span>
                                <span>dari</span>
                                <span class="font-black text-slate-800">
                                    {{ $posts->lastPage() }}
                                </span>
                            </div>

                            {{-- Tombol Next --}}
                            @if ($posts->hasMorePages())
                                <a href="{{ $posts->nextPageUrl() }}"
                                   class="px-4 py-2.5 rounded-xl bg-white border border-slate-200/80 text-slate-700 font-bold text-xs hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition flex items-center gap-1 shadow-xs">
                                    <span>Berikutnya</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <span class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-400 font-bold text-xs cursor-not-allowed flex items-center gap-1 select-none border border-slate-200/60">
                                    <span>Berikutnya</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            @endif

                        </div>
                    @endif

                </main>

                <!-- SIDEBAR NAVIGASI & SEARCH (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- SEARCH BOX WIDGET -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-3">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Cari Berita</h3>
                        <form action="{{ route('berita.index') }}" method="GET" class="relative">
                            @if(!empty($category) && $category !== 'semua')
                                <input type="hidden" name="kategori" value="{{ $category }}">
                            @endif
                            @if(!empty($activeTag))
                                <input type="hidden" name="tag" value="{{ $activeTag }}">
                            @endif

                            <input type="text"
                                   name="q"
                                   value="{{ request('q') }}"
                                   placeholder="Kata kunci berita..."
                                   class="w-full px-4 py-2.5 pl-10 pr-8 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs">

                            <button type="submit" class="absolute left-3 top-3 text-slate-400 hover:text-blue-600 cursor-pointer" title="Cari">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>

                            @if(!empty($search))
                                <a href="{{ route('berita.index', array_filter(['kategori' => $category !== 'semua' ? $category : null, 'tag' => $activeTag])) }}"
                                   class="absolute right-3 top-2.5 text-slate-400 hover:text-rose-500 font-bold text-xs"
                                   title="Hapus pencarian">
                                    ✕
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Kategori Berita Utama -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Kategori Utama
                        </h3>
                        <ul class="space-y-2 text-xs font-semibold text-slate-600">
                            <li>
                                <a href="{{ route('berita.index') }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition {{ empty($category) || $category === 'semua' ? 'text-blue-600 font-extrabold bg-blue-50' : '' }}">
                                    <span>Semua Kabar</span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 text-[10px]">{{ $totalSemua }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('berita.index', ['kategori' => 'berita']) }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition {{ $category === 'berita' ? 'text-blue-600 font-extrabold bg-blue-50' : '' }}">
                                    <span>Berita & Artikel Sekolah</span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 text-[10px]">{{ $totalBerita }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('berita.index', ['kategori' => 'prestasi']) }}" class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition {{ $category === 'prestasi' ? 'text-blue-600 font-extrabold bg-blue-50' : '' }}">
                                    <span>Prestasi & Pencapaian</span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 text-[10px]">{{ $totalPrestasi }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Widget Post Tags -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Tag Berita (Post Tag)
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($tags as $tag)
                                <a href="{{ route('berita.index', array_filter(['tag' => $tag->post_tag_slug, 'kategori' => $category !== 'semua' ? $category : null, 'q' => $search])) }}"
                                   class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition {{ $activeTag === $tag->post_tag_slug ? 'bg-blue-600 text-white border-blue-600' : 'bg-slate-50 text-slate-600 border-slate-200 hover:border-blue-400 hover:text-blue-600' }}">
                                    #{{ $tag->post_tag_name }}
                                    <span class="text-[10px] opacity-75">({{ $tag->posts_count }})</span>
                                </a>
                            @empty
                                <span class="text-xs text-slate-400 italic">Belum ada tag berita.</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Widget PPDB Call-to-Action -->
                    <div class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl p-6 text-slate-900 shadow-md space-y-4" data-aos="fade-up">
                        <div class="font-black text-lg leading-tight">
                            Bergabung Bersama Keluarga Maitreyawira!
                        </div>
                        <p class="text-xs text-slate-800 font-medium leading-relaxed">
                            Pendaftaran Murid Baru (PPDB) T.A 2026/2027 telah dibuka untuk jenjang TK, SD, SMP, dan SMA.
                        </p>
                        <a href="/pendaftaran-siswa" class="inline-block w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-amber-400 font-extrabold text-xs text-center rounded-xl shadow-xs transition">
                            Daftar PPDB Online Sekarang
                        </a>
                    </div>

                </aside>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @include('partials.footer')

    {{-- JS AOS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 100,
                easing: 'ease-out-cubic'
            });
        });
    </script>
</body>
</html>
