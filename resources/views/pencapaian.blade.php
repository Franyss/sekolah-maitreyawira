{{-- File: resources/views/pencapaian.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencapaian & Prestasi | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS, FontAwesome & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB --}}
    <x-hero-banner
        slug="pencapaian"
        badge="Rekam Jejak Keunggulan"
        title="Pencapaian & Prestasi"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Tentang Kami', 'url' => '#'],
            ['label' => 'Pencapaian & Prestasi', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-start">

                <!-- KONTEN UTAMA (8 Kolom) -->
                <main class="lg:col-span-8 space-y-10">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-200 pb-3" data-aos="fade-up">
                            <h3 class="text-xl font-black text-slate-900">Prestasi Murid & Sekolah</h3>
                            <span class="text-xs text-slate-500 font-medium">Diurutkan berdasarkan yang terbaru</span>
                        </div>

                        <!-- CARDS DINAMIS DATABASE ACHIEVEMENT -->
                        @if(isset($achievements) && $achievements->count() > 0)
                            @foreach($achievements as $index => $item)
                                @php
                                    $delay = ($index + 1) * 100;
                                    $slug = $item->achievement_slug ?: $item->achievement_id;
                                    $detailUrl = route('pencapaian.show', $slug);
                                    $formattedDate = \Carbon\Carbon::parse($item->datetime_created)->translatedFormat('Y');
                                @endphp

                                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-3 hover:border-blue-300 transition group flex flex-col justify-between"
                                     data-aos="fade-up" data-aos-delay="{{ $delay }}">
                                    <div class="space-y-3">
                                        <div class="flex flex-wrap items-center justify-between gap-2">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200 flex items-center gap-1.5">
                                                <i class="fa-solid fa-trophy text-amber-600"></i>
                                                Pencapaian Unggulan
                                            </span>
                                            <span class="text-xs text-slate-400 font-medium">{{ $formattedDate }}</span>
                                        </div>

                                        <h4 class="text-lg font-extrabold text-slate-900 group-hover:text-blue-600 transition leading-snug">
                                            <a href="{{ $detailUrl }}">{{ $item->achievement_title }}</a>
                                        </h4>

                                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-3">
                                            {{ strip_tags($item->achievement_content) }}
                                        </p>
                                    </div>

                                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-2">
                                        <a href="{{ $detailUrl }}" class="text-xs font-extrabold text-blue-600 hover:text-blue-800 transition inline-flex items-center gap-1.5">
                                            <span>Lihat Detail Rekam Jejak</span>
                                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                            {{-- NAVIGASI HALAMAN / PAGINASI --}}
                            @if(method_exists($achievements, 'hasPages') && $achievements->hasPages())
                                <div class="pt-6">
                                    {{ $achievements->links() }}
                                </div>
                            @endif
                        @else
                            <div class="bg-white rounded-2xl p-12 text-center text-slate-400 italic border border-dashed border-slate-200">
                                Belum ada data pencapaian atau prestasi yang dipublikasikan.
                            </div>
                        @endif

                    </div>
                </main>

                <!-- SIDEBAR NAVIGASI & INFORMASI (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- Menu Navigasi Sub-Halaman -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Tentang Kami
                        </h3>
                        <nav class="flex flex-col gap-1 text-xs font-bold text-slate-600">
                            <a href="/sejarah" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Sejarah Sekolah</span>
                                <i class="fa-solid fa-chevron-right text-slate-400 text-[10px]"></i>
                            </a>
                            <a href="/visi-misi-motto" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Visi, Misi & Motto</span>
                                <i class="fa-solid fa-chevron-right text-slate-400 text-[10px]"></i>
                            </a>
                            <a href="/program-unggulan" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Program Unggulan</span>
                                <i class="fa-solid fa-chevron-right text-slate-400 text-[10px]"></i>
                            </a>
                            <a href="/fasilitas" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Fasilitas Sekolah</span>
                                <i class="fa-solid fa-chevron-right text-slate-400 text-[10px]"></i>
                            </a>
                            <a href="/pencapaian" class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 text-blue-600 font-extrabold">
                                <span>Pencapaian & Prestasi</span>
                                <i class="fa-solid fa-chevron-right text-blue-600 text-[10px]"></i>
                            </a>
                            <a href="/testimoni" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Testimoni Orang Tua</span>
                                <i class="fa-solid fa-chevron-right text-slate-400 text-[10px]"></i>
                            </a>
                        </nav>
                    </div>

                    <!-- Widget PPDB Call-to-Action -->
                    <div class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl p-6 text-slate-900 shadow-md space-y-4" data-aos="fade-up" data-aos-delay="300">
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
