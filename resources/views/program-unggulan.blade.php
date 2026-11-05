{{-- File: resources/views/program-unggulan.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Unggulan | Sekolah Maitreyawira Palembang</title>

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
                <span class="text-amber-400">Program Unggulan</span>
            </nav>

            <div class="max-w-3xl space-y-4">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                    Keunggulan Pembelajaran
                </span>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    Program Unggulan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500">
                        Sekolah Maitreyawira Palembang
                    </span>
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Inovasi pendidikan komprehensif yang mengintegrasikan kecerdasan intelektual, emosional, spiritual, serta kepedulian terhadap lingkungan hidup.
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

                    <!-- INTRO PROGRAM UNGGULAN -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-black text-slate-900">Kurikulum Berbasis Karakter & Masa Depan</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Sinergi Pembelajaran Holistik</p>
                        </div>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Sekolah Maitreyawira Palembang berkomitmen menghadirkan pengalaman belajar yang tak hanya unggul secara akademis, namun juga relevan dengan tantangan global abad ke-21 tanpa menghilangkan nilai dasar budi pekerti dan etika universal.
                        </p>
                    </div>

                    <!-- DAFTAR PROGRAM UNGGULAN (CARDS) -->
                    <div class="space-y-6">

                        <!-- 1. Pendidikan Karakter Kasih Alam & Budi Pekerti -->
                        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="150">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 font-black flex items-center justify-center text-2xl shrink-0 group-hover:scale-105 transition">
                                        🌱
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-amber-600 uppercase tracking-widest block">Karakter & Etika</span>
                                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition">Pendidikan Budi Pekerti & Kasih Alam</h3>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Program rutin harian dan mingguan yang membiasakan murid bersikap sopan santun, mempraktikkan etika penghormatan, menerapkan pola hidup ramah lingkungan, serta menanamkan rasa empati terhadap sesama makhluk ciptaan Tuhan.
                            </p>
                            <div class="flex flex-wrap gap-2 pt-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Pembiasaan Etika Harian</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Gerakan Eco-Green Kampus</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Jumat Kasih Alam</span>
                            </div>
                        </div>

                        <!-- 2. Trilingual Program (Bahasa Indonesia, Inggris, Mandarin) -->
                        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="200">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 font-black flex items-center justify-center text-2xl shrink-0 group-hover:scale-105 transition">
                                        🗣️
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-blue-600 uppercase tracking-widest block">Komunikasi Global</span>
                                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition">Program Bahasa Trilingual</h3>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Penguasaan tiga bahasa utama (Bahasa Indonesia, Inggris, dan Mandarin) secara komprehensif melalui metode pembelajaran aktif, percakapan harian, serta kompetisi kebahasaan untuk menyiapkan murid bersaing secara global.
                            </p>
                            <div class="flex flex-wrap gap-2 pt-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">English Day & Mandarin Zone</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Persiapan Sertifikasi HSK & Cambridge</span>
                            </div>
                        </div>

                        <!-- 3. Literasi Digital & STEM / Coding -->
                        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="250">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 font-black flex items-center justify-center text-2xl shrink-0 group-hover:scale-105 transition">
                                        💻
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-purple-600 uppercase tracking-widest block">Teknologi & Inovasi</span>
                                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition">Literasi Digital, STEM & Robotik</h3>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Kurikulum berbasis STEM (Science, Technology, Engineering, & Mathematics) yang mengasah keterampilan berpikir kritis, logika pemrograman (coding), eksplorasi laboratorium komputer modern, serta pembuatan robotika dasar.
                            </p>
                            <div class="flex flex-wrap gap-2 pt-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Coding & Algoritma Dasar</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Klub Robotika & Sains</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Ruang Kelas Multimedia</span>
                            </div>
                        </div>

                        <!-- 4. Seni, Budaya & Ekstrakurikuler Multibakat -->
                        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="300">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 font-black flex items-center justify-center text-2xl shrink-0 group-hover:scale-105 transition">
                                        🎨
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest block">Kreativitas & Olahraga</span>
                                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition">Pengembangan Seni, Ekstrakurikuler & Leadership</h3>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Lebih dari 25 pilihan kegiatan ekstrakurikuler di bidang seni musik, seni tari tradisional & modern, olahraga, pramuka, hingga organisasi siswa untuk menumbuhkan rasa percaya diri dan karakter kepemimpinan.
                            </p>
                            <div class="flex flex-wrap gap-2 pt-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Seni Musik & Paduan Suara</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Pentas Seni Tahunan</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Pelatihan Kepemimpinan Siswa</span>
                            </div>
                        </div>

                        <!-- 5. Gaya Hidup Sehat & Kantin Vegetaris -->
                        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4 hover:border-blue-200 transition group" data-aos="fade-up" data-aos-delay="350">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 font-black flex items-center justify-center text-2xl shrink-0 group-hover:scale-105 transition">
                                        🥗
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-red-600 uppercase tracking-widest block">Kesehatan & Lingkungan</span>
                                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition">Gaya Hidup Sehat & Kantin Nutrisi Vegetaris</h3>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Menjaga kebugaran jasmani murid melalui fasilitas olahraga yang komprehensif serta penyediaan hidangan sehat, higienis, dan nutrisi berimbang di Kantin Vegetaris Sekolah.
                            </p>
                            <div class="flex flex-wrap gap-2 pt-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Menu Vegetaris Sehat & Higienis</span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">Edukasi Pola Makan Nutrisi Berimbang</span>
                            </div>
                        </div>

                    </div>

                    <!-- HIGHLIGHT CALLOUT -->
                    <div class="bg-gradient-to-br from-blue-900 to-slate-900 text-white rounded-2xl p-8 shadow-xl space-y-4" data-aos="zoom-in" data-aos-delay="200">
                        <h3 class="text-2xl font-black">Siap Menjadi Bagian dari Generasi Unggul?</h3>
                        <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                            Kami mengundang Bapak/Ibu untuk melihat langsung lingkungan belajar dan program pembelajaran di Sekolah Maitreyawira Palembang.
                        </p>
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
                            <a href="/program-unggulan" class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 text-blue-600 font-extrabold">
                                <span>Program Unggulan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/fasilitas" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Fasilitas Sekolah</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/pencapaian" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Pencapaian & Prestasi</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
