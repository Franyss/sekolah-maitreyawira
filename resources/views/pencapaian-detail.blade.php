{{-- File: resources/views/pencapaian-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $achievement->achievement_title }} | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS, FontAwesome & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO HEADER & BREADCRUMB --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-16 sm:py-20">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down" data-aos-duration="1000">
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center flex-wrap">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('pencapaian.index') }}" class="hover:text-amber-400 transition">Pencapaian & Prestasi</a>
                <span>/</span>
                <span class="text-amber-400 truncate max-w-xs sm:max-w-md">{{ $achievement->achievement_title }}</span>
            </nav>

            <div class="max-w-4xl space-y-3">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-amber-500/20 text-amber-300 border border-amber-500/30 uppercase tracking-widest">
                    🏆 Detail Prestasi & Rekam Jejak
                </span>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight text-white">
                    {{ $achievement->achievement_title }}
                </h1>

                <div class="flex items-center gap-3 text-xs text-slate-400 pt-2 font-medium">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar text-amber-400"></i>
                        {{ \Carbon\Carbon::parse($achievement->datetime_created)->translatedFormat('d F Y') }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-start">

                <!-- KONTEN UTAMA (8 Kolom) -->
                <main class="lg:col-span-8 space-y-8">

                    {{-- DESKRIPSI UTAMA PRESTASI --}}
                    @if(!empty($achievement->achievement_content))
                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-3" data-aos="fade-up">
                            <h2 class="text-xl font-bold text-slate-900">Ringkasan Kebanggaan</h2>
                            <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed">
                                {!! $achievement->achievement_content !!}
                            </div>
                        </div>
                    @endif

                    @php
                        $detailsList = isset($details) && count($details) > 0
                            ? $details
                            : ((isset($achievement->details) && $achievement->details->count() > 0)
                                ? $achievement->details
                                : collect());
                    @endphp

                    <!-- ITERASI KONTEN DETAIL PRESTASI (tabel achievement_detail) -->
                    @forelse($detailsList as $index => $itemDetail)
                        <article class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

                            <!-- 1. DESKRIPSI DETAIL (achievement_detail_desc) -->
                            @if(!empty($itemDetail->achievement_detail_desc))
                                <div class="border-b border-slate-100 pb-3">
                                    <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 leading-snug">
                                        {{ $itemDetail->achievement_detail_desc }}
                                    </h3>
                                </div>
                            @endif

                            <!-- 2. KONTEN DETAIL / GAMBAR DOKUMENTASI (achievement_detail_content) -->
                            @if(!empty($itemDetail->achievement_detail_content))
                                @php
                                    $rawContent = trim($itemDetail->achievement_detail_content);
                                    $fileName = basename($rawContent);

                                    $isImage = !empty($fileName) && (
                                        str_ends_with(strtolower($fileName), '.jpg') ||
                                        str_ends_with(strtolower($fileName), '.jpeg') ||
                                        str_ends_with(strtolower($fileName), '.png') ||
                                        str_ends_with(strtolower($fileName), '.webp') ||
                                        str_starts_with($rawContent, 'achievement-') ||
                                        str_starts_with($rawContent, 'uploads/')
                                    );

                                    if ($isImage) {
                                        if (file_exists(public_path('uploads/achievement_detail/' . $fileName))) {
                                            $imgUrl = asset('uploads/achievement_detail/' . $fileName);
                                        } elseif (file_exists(public_path('uploads/achievement/' . $fileName))) {
                                            $imgUrl = asset('uploads/achievement/' . $fileName);
                                        } elseif (file_exists(public_path('storage/' . $rawContent))) {
                                            $imgUrl = asset('storage/' . $rawContent);
                                        } elseif (str_starts_with($rawContent, 'http')) {
                                            $imgUrl = $rawContent;
                                        } else {
                                            $imgUrl = asset('uploads/achievement_detail/' . $fileName);
                                        }
                                    }
                                @endphp

                                @if($isImage)
                                    <div class="overflow-hidden rounded-xl border border-slate-200 max-h-[480px] bg-slate-100">
                                        <img src="{{ $imgUrl }}"
                                             alt="{{ $itemDetail->achievement_detail_desc }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.onerror=null; this.parentElement.style.display='none';">
                                    </div>
                                @else
                                    <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed space-y-3">
                                        {!! $rawContent !!}
                                    </div>
                                @endif
                            @endif

                            <!-- 3. PEMUTAR VIDEO YOUTUBE (achievement_detail_youtube_link) -->
                            @if(!empty($itemDetail->achievement_detail_youtube_link))
                                @php
                                    $ytId = '';
                                    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/))([\w-]{11})/', $itemDetail->achievement_detail_youtube_link, $matches)) {
                                        $ytId = $matches[1];
                                    }
                                @endphp

                                @if(!empty($ytId))
                                    <div class="my-4 space-y-2">
                                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Video Dokumentasi Kejuaraan:</h4>
                                        <div class="relative rounded-2xl overflow-hidden shadow-lg border border-slate-200 aspect-video bg-slate-900">
                                            <iframe class="w-full h-full"
                                                    src="https://www.youtube.com/embed/{{ $ytId }}"
                                                    title="Video {{ $itemDetail->achievement_detail_desc }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                @endif
                            @endif

                        </article>
                    @empty
                        @if(empty($achievement->achievement_content))
                            <div class="bg-white rounded-2xl p-12 text-center text-slate-400 italic border border-dashed border-slate-200">
                                Belum ada detail dokumentasi lanjutan untuk prestasi ini.
                            </div>
                        @endif
                    @endforelse

                    <!-- NAVIGASI KEMBALI -->
                    <div class="pt-4 flex items-center justify-between">
                        <a href="{{ route('pencapaian.index') }}"
                           class="px-5 py-2.5 bg-white border border-slate-200/80 hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl shadow-xs transition inline-flex items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Kembali ke Daftar Pencapaian</span>
                        </a>
                    </div>

                </main>

                <!-- SIDEBAR PRESTASI LAINNYA (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- Widget Prestasi Lainnya -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Prestasi Terbaru Lainnya
                        </h3>

                        <div class="space-y-3">
                            @if(isset($otherAchievements) && $otherAchievements->count() > 0)
                                @foreach($otherAchievements as $oa)
                                    @php $oaSlug = $oa->achievement_slug ?: $oa->achievement_id; @endphp
                                    <a href="{{ route('pencapaian.show', $oaSlug) }}"
                                       class="block p-3 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-200 transition group space-y-1">
                                        <h4 class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                            {{ $oa->achievement_title }}
                                        </h4>
                                        <span class="text-[10px] text-slate-400 font-medium block">
                                            <i class="fa-regular fa-calendar text-amber-500 mr-1"></i>
                                            {{ \Carbon\Carbon::parse($oa->datetime_created)->translatedFormat('d M Y') }}
                                        </span>
                                    </a>
                                @endforeach
                            @else
                                <p class="text-xs text-slate-400 italic">Belum ada data prestasi lainnya.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Widget Call-to-Action PPDB -->
                    <div class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl p-6 text-slate-900 shadow-md space-y-4">
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

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 800, once: true, offset: 100, easing: 'ease-out-cubic' });
        });
    </script>
</body>
</html>
