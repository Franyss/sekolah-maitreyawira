{{-- File: resources/views/pencapaian.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencapaian & Prestasi | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS & Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-16 sm:py-20">
        <!-- Background Overlay Pattern -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down" data-aos-duration="1000">
            <!-- Breadcrumb -->
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <span class="text-slate-300">Tentang Kami</span>
                <span>/</span>
                <span class="text-amber-400">Pencapaian & Prestasi</span>
            </nav>

            <div class="max-w-3xl space-y-4">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                    Rekam Jejak Keunggulan
                </span>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    Pencapaian & Prestasi <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500">
                        Sekolah Maitreyawira Palembang
                    </span>
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Dedikasi dan kerja keras civitas akademika dalam meraih keunggulan di bidang akademis, seni, budaya, olahraga, serta lingkungan hidup.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-start">

                <!-- KONTEN UTAMA (8 Kolom) -->
                <main class="lg:col-span-8 space-y-10">

                    <!-- HIGHLIGHT AKREDITASI & PENGHARGAAN -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-black text-slate-900">Pengakuan & Akreditasi Institusi</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Jaminan Mutu Pendidikan</p>
                        </div>

                        <div class="grid sm:grid-cols-3 gap-4 text-center">
                            <div class="p-5 rounded-xl bg-blue-50/60 border border-blue-100 space-y-1" data-aos="zoom-in" data-aos-delay="200">
                                <div class="text-3xl font-black text-blue-600">A</div>
                                <div class="text-xs font-bold text-slate-800 uppercase">Akreditasi Unggul</div>
                                <p class="text-[11px] text-slate-500">Jenjang TK, SD, SMP, SMA</p>
                            </div>
                            <div class="p-5 rounded-xl bg-amber-50/60 border border-amber-100 space-y-1" data-aos="zoom-in" data-aos-delay="300">
                                <div class="text-3xl font-black text-amber-600">🏆</div>
                                <div class="text-xs font-bold text-slate-800 uppercase">Sekolah Adiwiyata</div>
                                <p class="text-[11px] text-slate-500">Kategori Berbudaya Lingkungan</p>
                            </div>
                            <div class="p-5 rounded-xl bg-emerald-50/60 border border-emerald-100 space-y-1" data-aos="zoom-in" data-aos-delay="400">
                                <div class="text-3xl font-black text-emerald-600">100%</div>
                                <div class="text-xs font-bold text-slate-800 uppercase">Kelulusan PTN & PTS</div>
                                <p class="text-[11px] text-slate-500">Tingkat Kelulusan Alumni</p>
                            </div>
                        </div>
                    </div>

                    <!-- DAFTAR PRESTASI TERBARU (CARDS) -->
                    <div class="space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-200 pb-3" data-aos="fade-up">
                            <h3 class="text-xl font-black text-slate-900">Prestasi Murid & Sekolah</h3>
                            <span class="text-xs text-slate-500 font-medium">Diurutkan berdasarkan yang terbaru</span>
                        </div>

                        <!-- Card Prestasi 1 -->
                        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-3 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="150">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                    🥇 Juara 1 Tingkat Kota
                                </span>
                                <span class="text-xs text-slate-400 font-medium">2026</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition">
                                Olimpiade Sains Nasional (OSN) Bidang Matematika & Fisika
                            </h4>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                Perwakilan siswa SMA Maitreyawira berhasil menduduki peringkat pertama dalam kompetisi sains tingkat Kota Palembang dan melaju ke babak provinsi.
                            </p>
                            <div class="pt-2 text-xs font-semibold text-slate-500 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                Jenjang: SMA Maitreyawira
                            </div>
                        </div>

                        <!-- Card Prestasi 2 -->
                        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-3 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="200">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                    🎭 Festival Seni & Budaya
                                </span>
                                <span class="text-xs text-slate-400 font-medium">2025</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition">
                                Juara Umum Pentas Seni & Seni Tari Kreasi Nusantara
                            </h4>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                Tim Sanggar Tari Sekolah Maitreyawira berhasil memboyong piala Juara Umum atas penampilan seni tari bertema persaudaraan dan kasih alam.
                            </p>
                            <div class="pt-2 text-xs font-semibold text-slate-500 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                Jenjang: SMP & SMA Maitreyawira
                            </div>
                        </div>

                        <!-- Card Prestasi 3 -->
                        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-3 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="250">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    🗣️ Kejuaraan Bahasa
                                </span>
                                <span class="text-xs text-slate-400 font-medium">2025</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition">
                                Runner-up Speech Competition & Mandarin Storytelling
                            </h4>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                Murid SD dan SMP Maitreyawira mengukir prestasi dalam perlombaan pidato Bahasa Inggris dan penceritaan kisah Bahasa Mandarin tingkat regional.
                            </p>
                            <div class="pt-2 text-xs font-semibold text-slate-500 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                Jenjang: SD & SMP Maitreyawira
                            </div>
                        </div>

                        <!-- Card Prestasi 4 -->
                        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-3 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="300">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800 border border-purple-200">
                                    🌱 Penghargaan Lingkungan
                                </span>
                                <span class="text-xs text-slate-400 font-medium">2024</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition">
                                Anugerah Sekolah Hijau & Inovasi Bebas Sampah Plastik
                            </h4>
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                Pengakuan dari dinas lingkungan hidup atas konsistensi sekolah dalam pengolahan sampah mandiri dan gerakan pembawaan tempat makan/minum sendiri.
                            </p>
                            <div class="pt-2 text-xs font-semibold text-slate-500 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                Unit: Seluruh Kampus Maitreyawira
                            </div>
                        </div>

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
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/visi-misi-motto" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Visi, Misi & Motto</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/program-unggulan" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Program Unggulan</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/fasilitas" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Fasilitas Sekolah</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/pencapaian" class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 text-blue-600 font-extrabold">
                                <span>Pencapaian & Prestasi</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/testimoni" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Testimoni Orang Tua</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
