{{-- File: resources/views/berita-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS Library, FontAwesome & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO HEADER & BREADCRUMB --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-12 sm:py-16">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down" data-aos-duration="1000">
            <!-- Breadcrumb Navigasi -->
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center flex-wrap">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('berita.index') }}" class="hover:text-amber-400 transition">Berita & Informasi</a>
                <span>/</span>
                <span class="text-amber-400 truncate max-w-xs sm:max-w-md">{{ $post->title }}</span>
            </nav>

            <div class="max-w-4xl space-y-4">
                <!-- Badge Kategori & Unit Sekolah (post_school) -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                        📰 Berita & Artikel
                    </span>

                    @if($post->schools && $post->schools->count() > 0)
                        @foreach($post->schools as $sch)
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-black bg-amber-500 text-slate-950 uppercase tracking-widest shadow-xs">
                                <i class="fa-solid fa-school text-[10px] mr-1"></i>{{ $sch->sch_name ?? $sch->school_name ?? $sch->name ?? 'Sekolah' }}
                            </span>
                        @endforeach
                    @endif
                </div>

                <!-- Judul Artikel -->
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight text-white">
                    {{ $post->title }}
                </h1>

                <!-- Meta Informasi Artikel -->
                <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-slate-300 pt-2 border-t border-slate-800">
                    <div class="flex items-center gap-1.5">
                        <i class="fa-regular fa-user text-amber-400"></i>
                        <span>{{ $post->author->name ?? $post->author->username ?? 'Humas Maitreyawira' }}</span>
                    </div>
                    <span>•</span>
                    <div class="flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar text-amber-400"></i>
                        <span>{{ \Carbon\Carbon::parse($post->datetime_created)->translatedFormat('d F Y') }}</span>
                    </div>
                    <span>•</span>
                    <div class="flex items-center gap-1.5">
                        <i class="fa-regular fa-eye text-amber-400"></i>
                        <span>{{ $post->total_views }} Dilihat</span>
                    </div>
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

                        <!-- GAMBAR SAMPUL / THUMBNAIL ARTIKEL -->
                        @php
                            $thumb = $post->thumbnail;
                            $fileName = basename($thumb ?? '');

                            if (!empty($fileName) && file_exists(public_path('uploads/post/' . $fileName))) {
                                $imgUrl = asset('uploads/post/' . $fileName);
                            } elseif (!empty($fileName) && file_exists(public_path('storage/post/' . $fileName))) {
                                $imgUrl = asset('storage/post/' . $fileName);
                            } elseif (!empty($thumb) && str_starts_with($thumb, 'http')) {
                                $imgUrl = $thumb;
                            } else {
                                $imgUrl = 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&w=1200&q=80';
                            }
                        @endphp

                        <div class="overflow-hidden rounded-xl border border-slate-100 max-h-[420px] bg-slate-100">
                            <img src="{{ $imgUrl }}"
                                 alt="{{ $post->title }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <!-- LIST UNIT SEKOLAH DALAM KARTU ARTIKEL -->
                        @if($post->schools && $post->schools->count() > 0)
                            <div class="flex flex-wrap items-center gap-2 p-4 bg-amber-50/60 border border-amber-200/70 rounded-xl">
                                <span class="text-xs font-bold text-slate-700 flex items-center gap-1.5">
                                    <i class="fa-solid fa-school text-amber-500"></i> Unit Sekolah Terkait:
                                </span>
                                @foreach($post->schools as $sch)
                                    <span class="px-2.5 py-1 bg-amber-500 text-slate-950 rounded-lg text-xs font-black shadow-xs">
                                        {{ $sch->sch_name ?? $sch->school_name ?? $sch->name ?? 'Sekolah' }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <!-- ISI TEKS ARTIKEL -->
                        <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed space-y-4 pt-2">
                            {!! $post->content !!}
                        </div>

                        <!-- TAG BERITA & NAVIGASI KEMBALI -->
                        <div class="pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                            @if(isset($post->tags) && $post->tags->count() > 0)
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-xs font-bold text-slate-500">Tag:</span>
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('berita.index', ['tag' => $tag->post_tag_slug]) }}"
                                           class="px-3 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                            #{{ $tag->post_tag_name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center gap-2">
                                <a href="{{ route('berita.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition flex items-center gap-1.5">
                                    <i class="fa-solid fa-arrow-left text-[11px]"></i>
                                    <span>Kembali ke Daftar Berita</span>
                                </a>
                            </div>
                        </div>

                    </article>
                </main>

                <!-- SIDEBAR NAVIGASI & ARTIKEL TERBARU (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- WIDGET BERITA TERBARU -->
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
                                    } elseif (!empty($recentFileName) && file_exists(public_path('storage/post/' . $recentFileName))) {
                                        $rImgUrl = asset('storage/post/' . $recentFileName);
                                    } elseif (!empty($recentThumb) && str_starts_with($recentThumb, 'http')) {
                                        $rImgUrl = $recentThumb;
                                    } else {
                                        $rImgUrl = 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&w=300&q=80';
                                    }
                                @endphp
                                <a href="{{ route('berita.show', $recent->slug) }}" class="flex items-start gap-3 group">
                                    <img src="{{ $rImgUrl }}"
                                         alt="{{ $recent->title }}"
                                         class="w-16 h-16 rounded-xl object-cover shrink-0 border border-slate-100 group-hover:scale-105 transition duration-300">
                                    <div class="space-y-1">
                                        <!-- BADGE UNIT SEKOLAH (POST_SCHOOL) PADA SIDEBAR -->
                                        @if($recent->schools && $recent->schools->count() > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($recent->schools as $rsch)
                                                    <span class="text-[9px] font-black text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200 uppercase">
                                                        {{ $rsch->sch_name ?? $rsch->school_name ?? $rsch->name ?? 'Sekolah' }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                            {{ $recent->title }}
                                        </h4>
                                        <span class="text-[10px] text-slate-400 flex items-center gap-1">
                                            <i class="fa-regular fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($recent->datetime_created)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </a>
                            @empty
                                <p class="text-xs text-slate-400 italic">Belum ada artikel terbaru lainnya.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- WIDGET TAG BERITA -->
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

                    <!-- WIDGET PPDB CALL-TO-ACTION -->
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

    {{-- JS AOS Library --}}
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
