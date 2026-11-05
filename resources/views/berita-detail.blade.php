{{-- File: resources/views/berita-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS & Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO HEADER & BREADCRUMB --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-12 sm:py-16">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down" data-aos-duration="1000">
            <!-- Breadcrumb -->
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center flex-wrap">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('berita.index') }}" class="hover:text-amber-400 transition">Berita & Informasi</a>
                <span>/</span>
                <span class="text-amber-400 truncate max-w-xs sm:max-w-md">{{ $article->title }}</span>
            </nav>

            <div class="max-w-4xl space-y-4">
                <!-- Badge Kategori -->
                @if($article->type === 'prestasi')
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-amber-500/20 text-amber-300 border border-amber-500/30 uppercase tracking-widest">
                        🏆 Prestasi & Pencapaian
                    </span>
                @else
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                        📰 Berita & Artikel
                    </span>
                @endif

                <!-- Judul Artikel -->
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight text-white">
                    {{ $article->title }}
                </h1>

                <!-- Meta Informasi Artikel -->
                <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-slate-300 pt-2 border-t border-slate-800">
                    <div class="flex items-center gap-1.5">
                        <span class="text-amber-400">👤</span>
                        <span>{{ $article->author }}</span>
                    </div>
                    <span>•</span>
                    <div class="flex items-center gap-1.5">
                        <span class="text-amber-400">📅</span>
                        <span>{{ \Carbon\Carbon::parse($article->datetime_created)->translatedFormat('d F Y') }}</span>
                    </div>
                    @if($article->type === 'berita')
                        <span>•</span>
                        <div class="flex items-center gap-1.5">
                            <span class="text-amber-400">👁️</span>
                            <span>{{ $article->total_views }} Dilihat</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-12 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-start">

                <!-- KONTEN ISI BERITA (8 Kolom) -->
                <main class="lg:col-span-8 space-y-8">
                    <article class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up">

                        <!-- Gambar Sampul / Thumbnail -->
                        @php
                            $thumb = $article->thumbnail;
                            $fileName = basename($thumb ?? '');

                            if ($article->type === 'prestasi') {
                                $imgUrl = 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?auto=format&fit=crop&w=1200&q=80';
                            } elseif (!empty($fileName) && file_exists(public_path('uploads/post/' . $fileName))) {
                                $imgUrl = asset('uploads/post/' . $fileName);
                            } elseif (!empty($fileName) && file_exists(public_path('storage/post/' . $fileName))) {
                                $imgUrl = asset('storage/post/' . $fileName);
                            } else {
                                $imgUrl = 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&w=1200&q=80';
                            }
                        @endphp

                        <div class="overflow-hidden rounded-xl border border-slate-100 max-h-[420px] bg-slate-100">
                            <img src="{{ $imgUrl }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <!-- Isi Teks Artikel -->
                        <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed space-y-4 pt-2">
                            {!! $article->content !!}
                        </div>

                        <!-- Tags & Bagikan -->
                        <div class="pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                            @if(isset($article->tags) && $article->tags->count() > 0)
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-xs font-bold text-slate-500">Tag:</span>
                                    @foreach($article->tags as $tag)
                                        <a href="{{ route('berita.index', ['tag' => $tag->post_tag_slug]) }}"
                                           class="px-3 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                            #{{ $tag->post_tag_name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center gap-2">
                                <a href="{{ route('berita.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition flex items-center gap-1.5">
                                    <span>← Kembali ke Daftar Berita</span>
                                </a>
                            </div>
                        </div>

                    </article>
                </main>

                <!-- SIDEBAR NAVIGASI & ARTIKEL TERBARU (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- Widget Berita Terbaru -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Kabar Terbaru Lainnya
                        </h3>
                        <div class="space-y-4">
                            @forelse($recentPosts as $recent)
                                @php
                                    $recentThumb = $recent->thumbnail;
                                    $recentFileName = basename($recentThumb ?? '');
                                    if (!empty($recentFileName) && file_exists(public_path('uploads/post/' . $recentFileName))) {
                                        $rImgUrl = asset('uploads/post/' . $recentFileName);
                                    } else {
                                        $rImgUrl = 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&w=300&q=80';
                                    }
                                @endphp
                                <a href="{{ route('berita.show', $recent->slug) }}" class="flex items-start gap-3 group">
                                    <img src="{{ $rImgUrl }}"
                                         alt="{{ $recent->title }}"
                                         class="w-16 h-16 rounded-xl object-cover shrink-0 border border-slate-100 group-hover:scale-105 transition">
                                    <div class="space-y-1">
                                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                            {{ $recent->title }}
                                        </h4>
                                        <span class="text-[10px] text-slate-400 block">
                                            📅 {{ \Carbon\Carbon::parse($recent->datetime_created)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </a>
                            @empty
                                <p class="text-xs text-slate-400 italic">Belum ada artikel terbaru lainnya.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Widget Post Tags -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Tag Berita
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($tags as $tag)
                                <a href="{{ route('berita.index', ['tag' => $tag->post_tag_slug]) }}"
                                   class="px-3 py-1.5 rounded-lg text-xs font-semibold border bg-slate-50 text-slate-600 border-slate-200 hover:border-blue-400 hover:text-blue-600 transition">
                                    #{{ $tag->post_tag_name }}
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
