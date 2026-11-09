{{-- File: resources/views/program-unggulan.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Unggulan | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS, FontAwesome & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB (KONSISTEN DENGAN HALAMAN VISI-MISI & SEJARAH) --}}
    <x-hero-banner
        slug="program-unggulan"
        badge="Keunggulan Pembelajaran"
        title="Program Unggulan"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Tentang Kami', 'url' => '#'],
            ['label' => 'Program Unggulan', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">

                <!-- KONTEN UTAMA (8 Kolom Grid) -->
                <main class="lg:col-span-8 space-y-8">

                    <!-- DESKRIPSI UTAMA -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-3" data-aos="fade-up">
                        <h2 class="text-2xl font-black text-slate-900">Pendidikan Berbasis Karakter & Masa Depan</h2>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Sekolah Maitreyawira Palembang berfokus pada pendidikan karakter dan kecerdasan akademis. Menjadi rumah kedua yang hangat bagi peserta didik, penuh dengan keceriaan melalui motto <strong class="text-slate-800">"Antusias, Ramah, Kasih"</strong>.
                        </p>
                    </div>

                    <!-- DAFTAR PROGRAM UNGGULAN -->
                    <div class="grid sm:grid-cols-2 gap-6">

                        @if(isset($programs) && $programs->count() > 0)
                            @foreach($programs as $index => $item)
                                @php
                                    $delay = ($index + 1) * 100;
                                    $slug = $item->program_slug ?: $item->program_id;
                                    $detailUrl = route('program.show', $slug);

                                    $titleLower = strtolower($item->program_title);
                                    if (str_contains($titleLower, 'karakter')) {
                                        $iconClass = 'fa-heart-circle-check text-amber-500';
                                        $bgColor = 'bg-amber-50 border-amber-200/60';
                                    } elseif (str_contains($titleLower, 'bahasa')) {
                                        $iconClass = 'fa-language text-blue-500';
                                        $bgColor = 'bg-blue-50 border-blue-200/60';
                                    } elseif (str_contains($titleLower, 'kecakapan') || str_contains($titleLower, 'hidup')) {
                                        $iconClass = 'fa-lightbulb text-purple-500';
                                        $bgColor = 'bg-purple-50 border-purple-200/60';
                                    } elseif (str_contains($titleLower, 'akademik')) {
                                        $iconClass = 'fa-graduation-cap text-emerald-500';
                                        $bgColor = 'bg-emerald-50 border-emerald-200/60';
                                    } else {
                                        $iconClass = 'fa-palette text-rose-500';
                                        $bgColor = 'bg-rose-50 border-rose-200/60';
                                    }
                                @endphp

                                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition duration-300 flex flex-col justify-between group"
                                     data-aos="fade-up" data-aos-delay="{{ $delay }}">

                                    <div class="space-y-4">
                                        <!-- IKON PROGRAM -->
                                        <div class="w-14 h-14 rounded-2xl {{ $bgColor }} border flex items-center justify-center text-2xl shrink-0 group-hover:scale-110 transition shadow-xs">
                                            <i class="fa-solid {{ $iconClass }}"></i>
                                        </div>

                                        <!-- JUDUL PROGRAM -->
                                        <h3 class="text-lg font-black text-slate-900 group-hover:text-blue-600 transition leading-snug">
                                            <a href="{{ $detailUrl }}">{{ $item->program_title }}</a>
                                        </h3>

                                        <!-- RINGKASAN TEKS DESKRIPSI -->
                                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-4">
                                            {{ strip_tags($item->program_content) }}
                                        </p>
                                    </div>

                                    <!-- TOMBOL LEBIH LANJUT -->
                                    <div class="pt-6 mt-4 border-t border-slate-100">
                                        <a href="{{ $detailUrl }}"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white font-extrabold text-xs transition duration-200 group/btn">
                                            <span>Lebih Lanjut</span>
                                            <i class="fa-solid fa-arrow-right text-[11px] group-hover/btn:translate-x-1 transition"></i>
                                        </a>
                                    </div>

                                </div>
                            @endforeach

                        @else
                            {{-- FALLBACK STATIS RESMI JIKA TABEL PROGRAM KOSONG --}}
                            @php
                                $fallbackPrograms = [
                                    [
                                        'title' => 'Pembinaan Karakter',
                                        'slug' => 'pembinaan-karakter',
                                        'icon' => 'fa-heart-circle-check text-amber-500',
                                        'bg' => 'bg-amber-50 border-amber-200/60',
                                        'desc' => 'Sekolah Maitreyawira berfokus pada pendidikan karakter, menjadi rumah kedua yang hangat bagi peserta didik melalui motto Antusias, Ramah, Kasih.'
                                    ],
                                    [
                                        'title' => 'Pengembangan Bahasa Asing',
                                        'slug' => 'pengembangan-bahasa-asing',
                                        'icon' => 'fa-language text-blue-500',
                                        'bg' => 'bg-blue-50 border-blue-200/60',
                                        'desc' => 'Mempersiapkan peserta didik mampu bersaing global melalui Bahasa Mandarin dan Bahasa Inggris standar internasional HSK/HSKK/YCT serta program Summer/Winter Camp.'
                                    ],
                                    [
                                        'title' => 'Kecakapan Hidup',
                                        'slug' => 'kecakapan-hidup',
                                        'icon' => 'fa-lightbulb text-purple-500',
                                        'bg' => 'bg-purple-50 border-purple-200/60',
                                        'desc' => 'Pembekalan keterampilan mandiri, percaya diri, bertanggung jawab, dan berpikir kreatif untuk hidup bermasyarakat.'
                                    ],
                                    [
                                        'title' => 'Akademik',
                                        'slug' => 'akademik',
                                        'icon' => 'fa-graduation-cap text-emerald-500',
                                        'bg' => 'bg-emerald-50 border-emerald-200/60',
                                        'desc' => 'Pendidikan akademis unggul dengan tenaga pendidik berkompeten serta prestasi dalam berbagai jenis perlombaan dan olimpiade.'
                                    ],
                                    [
                                        'title' => 'Pengembangan Talenta',
                                        'slug' => 'pengembangan-talenta',
                                        'icon' => 'fa-palette text-rose-500',
                                        'bg' => 'bg-rose-50 border-rose-200/60',
                                        'desc' => 'Memfasilitasi potensi unik setiap anak melalui kegiatan ekstrakurikuler seni, olahraga, dan Teknologi Informasi.'
                                    ]
                                ];
                            @endphp

                            @foreach($fallbackPrograms as $item)
                                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition duration-300 flex flex-col justify-between group" data-aos="fade-up">
                                    <div class="space-y-4">
                                        <div class="w-14 h-14 rounded-2xl {{ $item['bg'] }} border flex items-center justify-center text-2xl shrink-0 group-hover:scale-110 transition shadow-xs">
                                            <i class="fa-solid {{ $item['icon'] }}"></i>
                                        </div>

                                        <h3 class="text-lg font-black text-slate-900 group-hover:text-blue-600 transition leading-snug">
                                            <a href="/program-unggulan/{{ $item['slug'] }}">{{ $item['title'] }}</a>
                                        </h3>

                                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-4">
                                            {{ $item['desc'] }}
                                        </p>
                                    </div>

                                    <div class="pt-6 mt-4 border-t border-slate-100">
                                        <a href="/program-unggulan/{{ $item['slug'] }}"
                                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white font-extrabold text-xs transition duration-200 group/btn">
                                            <span>Lebih Lanjut</span>
                                            <i class="fa-solid fa-arrow-right text-[11px] group-hover/btn:translate-x-1 transition"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>

                    <!-- BANNER CALLOUT PPDB -->
                    <div class="bg-gradient-to-br from-blue-900 to-slate-900 text-white rounded-2xl p-8 shadow-xl space-y-3" data-aos="zoom-in">
                        <h3 class="text-xl sm:text-2xl font-black">Siap Menjadi Bagian dari Generasi Unggul?</h3>
                        <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                            Mari bergabung bersama Sekolah Maitreyawira Palembang dan ciptakan masa depan cerah penuh potensi bagi buah hati Anda.
                        </p>
                    </div>

                </main>

                <!-- SIDEBAR NAVIGASI & INFORMATION (4 Kolom) -->
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
                            <a href="/program-unggulan" class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 text-blue-600 font-extrabold">
                                <span>Program Unggulan</span>
                                <i class="fa-solid fa-chevron-right text-blue-600 text-[10px]"></i>
                            </a>
                            <a href="/fasilitas" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Fasilitas Sekolah</span>
                                <i class="fa-solid fa-chevron-right text-slate-400 text-[10px]"></i>
                            </a>
                        </nav>
                    </div>

                    <!-- Widget PPDB Call-to-Action -->
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
