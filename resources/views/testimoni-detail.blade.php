{{-- File: resources/views/testimoni-detail.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Testimoni - {{ $testimony->testimony_title }} | Sekolah Maitreyawira Palembang</title>

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
    <section class="relative bg-slate-900 text-white overflow-hidden py-12 sm:py-16">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down">
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center flex-wrap">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('testimoni.index') }}" class="hover:text-amber-400 transition">Testimoni</a>
                <span>/</span>
                <span class="text-amber-400 truncate max-w-xs sm:max-w-md">{{ $testimony->testimony_title }}</span>
            </nav>

            <div class="max-w-4xl space-y-3">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-amber-500 text-slate-950 uppercase tracking-widest">
                    💬 Testimoni Orang Tua
                </span>
                <h1 class="text-2xl sm:text-4xl font-black tracking-tight leading-tight text-white">
                    {{ $testimony->testimony_title }}
                </h1>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA & RINCIAN TESTIMONY_DETAIL --}}
    <section class="py-12 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">

                <!-- KONTEN RINCIAN (8 KOLOM) -->
                <main class="lg:col-span-8 space-y-8">

                    <!-- KARTU TESTIMONI UTAMA -->
                    <article class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up">
                        <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-900 text-amber-400 font-extrabold flex items-center justify-center text-sm border border-blue-800 shadow-xs">
                                    {{ strtoupper(substr($testimony->testimony_title, 10, 2) ?: 'MW') }}
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900">Orang Tua Siswa</h3>
                                    <p class="text-xs text-slate-500 font-medium">{{ $testimony->testimony_title }} Sekolah Maitreyawira</p>
                                </div>
                            </div>
                            <svg class="w-8 h-8 text-amber-400 opacity-80" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <!-- ISI TEKS TESTIMONI UTAMA -->
                        <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed">
                            {!! nl2br(e($testimony->testimony_content)) !!}
                        </div>
                    </article>

                    <!-- SEKSI TABEL TESTIMONY_DETAIL -->
                    @if($testimony->details && $testimony->details->count() > 0)
                        <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
                            <h3 class="text-base font-black text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-200 pb-3">
                                <i class="fa-solid fa-photo-film text-amber-500"></i>
                                <span>Dokumentasi & Rincian Testimoni</span>
                            </h3>

                            <div class="grid gap-6">
                                @foreach($testimony->details as $detail)
                                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">

                                        <!-- Deskripsi Detail (testimony_detail_desc) -->
                                        @if(!empty($detail->testimony_detail_desc))
                                            <div class="text-xs sm:text-sm font-semibold text-slate-800 leading-relaxed flex items-start gap-2">
                                                <i class="fa-solid fa-circle-info text-blue-600 mt-1 shrink-0"></i>
                                                <span>{{ $detail->testimony_detail_desc }}</span>
                                            </div>
                                        @endif

                                        <!-- Konten Media Gambar / Teks (testimony_detail_content) -->
                                        @if(!empty($detail->testimony_detail_content))
                                            @php
                                                $rawContent = trim($detail->testimony_detail_content);
                                                $fileName = basename($rawContent);

                                                $isImage = !empty($fileName) && (
                                                    str_ends_with(strtolower($fileName), '.jpg') ||
                                                    str_ends_with(strtolower($fileName), '.jpeg') ||
                                                    str_ends_with(strtolower($fileName), '.png') ||
                                                    str_ends_with(strtolower($fileName), '.webp') ||
                                                    str_starts_with($rawContent, 'testimony-') ||
                                                    str_starts_with($rawContent, 'uploads/')
                                                );

                                                if ($isImage) {
                                                    if (file_exists(public_path('uploads/testimony_detail/' . $fileName))) {
                                                        $detailImgUrl = asset('uploads/testimony_detail/' . $fileName);
                                                    } elseif (file_exists(public_path('uploads/testimony/' . $fileName))) {
                                                        $detailImgUrl = asset('uploads/testimony/' . $fileName);
                                                    } elseif (file_exists(public_path('storage/' . $rawContent))) {
                                                        $detailImgUrl = asset('storage/' . $rawContent);
                                                    } elseif (str_starts_with($rawContent, 'http')) {
                                                        $detailImgUrl = $rawContent;
                                                    } else {
                                                        $detailImgUrl = asset('uploads/testimony_detail/' . $fileName);
                                                    }
                                                }
                                            @endphp

                                            @if($isImage)
                                                <div class="overflow-hidden rounded-xl border border-slate-100 max-h-96 bg-slate-100">
                                                    <img src="{{ $detailImgUrl }}"
                                                         alt="{{ $detail->testimony_detail_desc ?? 'Dokumentasi Testimoni' }}"
                                                         class="w-full h-full object-cover hover:scale-105 transition duration-500"
                                                         onerror="this.onerror=null; this.parentElement.style.display='none';">
                                                </div>
                                            @else
                                                <div class="prose prose-slate max-w-none text-slate-700 text-xs sm:text-sm leading-relaxed p-4 bg-slate-50 rounded-xl border border-slate-100">
                                                    {!! $rawContent !!}
                                                </div>
                                            @endif
                                        @endif

                                        <!-- Pemutar Video YouTube (testimony_detail_youtube_link) -->
                                        @if(!empty($detail->testimony_detail_youtube_link))
                                            @php
                                                $ytId = '';
                                                if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/))([\w-]{11})/', $detail->testimony_detail_youtube_link, $matches)) {
                                                    $ytId = $matches[1];
                                                }

                                                $ytThumbUrl = "https://img.youtube.com/vi/{$ytId}/maxresdefault.jpg";
                                                $ytThumbFallback = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
                                                $ytWatchUrl = "https://www.youtube.com/watch?v={$ytId}";
                                            @endphp

                                            @if(!empty($ytId))
                                                <div class="space-y-2 pt-2">
                                                    <span class="text-xs font-bold text-slate-700 flex items-center gap-1.5">
                                                        <i class="fa-brands fa-youtube text-rose-600"></i> Video Kesaksian Orang Tua:
                                                    </span>

                                                    <div class="relative rounded-xl overflow-hidden shadow-md border border-slate-200 aspect-video bg-slate-900 group">
                                                        <img src="{{ $ytThumbUrl }}"
                                                             alt="Thumbnail Video Testimoni"
                                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                                             onerror="this.onerror=null; this.src='{{ $ytThumbFallback }}';">

                                                        <a href="{{ $ytWatchUrl }}"
                                                           target="_blank"
                                                           rel="noopener noreferrer"
                                                           title="Tonton Testimoni di YouTube"
                                                           class="absolute inset-0 bg-slate-950/40 hover:bg-slate-950/20 transition flex items-center justify-center group/btn">
                                                            <div class="w-16 h-16 rounded-full bg-[#4f56e9] hover:bg-[#3d44d4] flex items-center justify-center shadow-xl border border-indigo-400/40 transform group-hover/btn:scale-110 transition duration-300">
                                                                <i class="fa-solid fa-play text-2xl text-slate-950 translate-x-0.5"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- TOMBOL KEMBALI -->
                    <div class="pt-4 border-t border-slate-200">
                        <a href="{{ route('testimoni.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition inline-flex items-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Kembali ke Daftar Testimoni</span>
                        </a>
                    </div>
                </main>

                <!-- SIDEBAR TESTIMONI LAINNYA (4 KOLOM) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Testimoni Lainnya
                        </h3>

                        <div class="space-y-4">
                            @forelse($otherTestimonies as $other)
                                <a href="{{ route('testimoni.show', $other->testimony_slug ?? $other->testimony_id) }}" class="block p-3 rounded-xl bg-slate-50 hover:bg-amber-50/60 border border-slate-100 hover:border-amber-200 transition group space-y-1">
                                    <span class="text-[10px] font-black text-amber-700 uppercase bg-amber-100 px-2 py-0.5 rounded-md">
                                        {{ $other->testimony_title }}
                                    </span>
                                    <p class="text-xs font-bold text-slate-900 group-hover:text-amber-600 transition line-clamp-2 leading-snug">
                                        {{ strip_tags($other->testimony_content) }}
                                    </p>
                                </a>
                            @empty
                                <p class="text-xs text-slate-400 italic">Belum ada testimoni lainnya.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- WIDGET PPDB CALL TO ACTION -->
                    <div class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl p-6 text-slate-900 shadow-md space-y-4">
                        <div class="font-black text-lg leading-tight">
                            Daftarkan Putra-Putri Anda Sekarang!
                        </div>
                        <p class="text-xs text-slate-800 font-medium leading-relaxed">
                            Pendaftaran Murid Baru (PPDB) T.A 2026/2027 telah dibuka untuk jenjang TK, SD, SMP, dan SMA.
                        </p>
                        <a href="https://spmb.maitreyawira-palembang.sch.id" target="_blank" class="inline-block w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-amber-400 font-extrabold text-xs text-center rounded-xl shadow-xs transition">
                            Pendaftaran SPMB Online
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
