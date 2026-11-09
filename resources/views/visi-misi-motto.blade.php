{{-- File: resources/views/visi-misi-motto.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi, Misi & Motto | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS & Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    @php
        // Fallback langsung dari DB jika $configs belum dikirim via controller
        $pageConfigs = $configs ?? \Illuminate\Support\Facades\DB::table('app_config')
            ->whereIn('conf_key', ['app_page_vision', 'app_page_mission', 'app_page_motto'])
            ->pluck('conf_value', 'conf_key');
    @endphp

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB (MEMANGGIL PARTIALS/HERO-BANNER DENGAN TAG COMPONENT) --}}
    <x-hero-banner
        slug="visi-misi-motto"
        badge="Profil Lembaga"
        title="Visi, Misi & Motto"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Tentang Kami', 'url' => '#'],
            ['label' => 'Visi, Misi & Motto', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-start">

                <!-- KONTEN UTAMA (8 Kolom) -->
                <main class="lg:col-span-8 space-y-10">

                    <!-- VISI SEKOLAH (DINAMIS DARI app_page_vision) -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-6 relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-black text-slate-900">Visi Sekolah</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-0.5">Pandangan Masa Depan Institusi</p>
                        </div>

                        <div class="p-6 bg-gradient-to-br from-blue-50/60 to-slate-50 rounded-2xl border border-blue-100/80" data-aos="zoom-in" data-aos-delay="200">
                            <div class="text-slate-800 font-extrabold text-lg sm:text-xl leading-relaxed italic text-center">
                                "{!! $pageConfigs['app_page_vision'] ?? 'Terwujudnya Keindahan Kodrati Manusia' !!}"
                            </div>
                        </div>
                    </div>

                    <!-- MISI SEKOLAH (DINAMIS DARI app_page_mission) -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-black text-slate-900">Misi Sekolah</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-0.5">Langkah & Komitmen Strategis</p>
                        </div>

                        <div class="text-slate-700 text-sm sm:text-base leading-relaxed prose max-w-none">
                            @if(!empty($pageConfigs['app_page_mission']))
                                {!! $pageConfigs['app_page_mission'] !!}
                            @else
                                <div class="space-y-3">
                                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100/80 flex items-center gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-600 shrink-0"></span>
                                        <h3 class="font-bold text-slate-900 text-sm sm:text-base">Meyakini Harkat Hidup Manusia adalah Tak Ternilai</h3>
                                    </div>
                                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100/80 flex items-center gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-600 shrink-0"></span>
                                        <h3 class="font-bold text-slate-900 text-sm sm:text-base">Menjunjung Kemuliaan Hidup Semua Makhluk</h3>
                                    </div>
                                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100/80 flex items-center gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-600 shrink-0"></span>
                                        <h3 class="font-bold text-slate-900 text-sm sm:text-base">Mengasihi Alam Semesta</h3>
                                    </div>
                                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100/80 flex items-center gap-3">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-600 shrink-0"></span>
                                        <h3 class="font-bold text-slate-900 text-sm sm:text-base">Mewujudkan Dunia Satu Keluarga</h3>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- MOTTO SEKOLAH (DINAMIS DARI app_page_motto) -->
                    <div class="bg-gradient-to-br from-blue-900 via-slate-900 to-slate-950 text-white rounded-2xl p-8 shadow-xl space-y-6 relative overflow-hidden" data-aos="zoom-in" data-aos-delay="200">
                        <div class="border-b border-slate-800 pb-4">
                            <h2 class="text-2xl font-black text-white">Motto Sekolah</h2>
                            <p class="text-xs text-amber-400 font-bold uppercase tracking-wider mt-0.5">Semboyan Utama</p>
                        </div>

                        <div class="text-center py-6 space-y-3">
                            <div class="text-2xl sm:text-4xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500 uppercase" data-aos="fade-up" data-aos-delay="300">
                                "{!! $pageConfigs['app_page_motto'] ?? 'ANTUSIAS, RAMAH, KASIH' !!}"
                            </div>
                        </div>
                    </div>

                    <!-- CORE VALUES (NILAI UTAMA) -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-black text-slate-900">Nilai-Nilai Utama (Core Values)</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Prinsip Karakter Pelajar Maitreyawira</p>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="p-5 rounded-xl border border-slate-200/80 bg-slate-50/50 space-y-2" data-aos="fade-right" data-aos-delay="250">
                                <h3 class="text-blue-600 font-extrabold text-base">Integritas</h3>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Jujur, dapat dipercaya, konsisten dalam ucapan dan tindakan luhur.
                                </p>
                            </div>

                            <div class="p-5 rounded-xl border border-slate-200/80 bg-slate-50/50 space-y-2" data-aos="fade-left" data-aos-delay="300">
                                <h3 class="text-amber-600 font-extrabold text-base">Kasih Semesta</h3>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Menyayangi sesama, toleran terhadap perbedaan, serta berempati tinggi.
                                </p>
                            </div>

                            <div class="p-5 rounded-xl border border-slate-200/80 bg-slate-50/50 space-y-2" data-aos="fade-right" data-aos-delay="350">
                                <h3 class="text-emerald-600 font-extrabold text-base">Kasih Alam</h3>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Menjaga kebersihan, menghemat energi, dan mencintai kelestarian bumi.
                                </p>
                            </div>

                            <div class="p-5 rounded-xl border border-slate-200/80 bg-slate-50/50 space-y-2" data-aos="fade-left" data-aos-delay="400">
                                <h3 class="text-indigo-600 font-extrabold text-base">Semangat Berprestasi</h3>
                                <p class="text-slate-600 text-xs leading-relaxed">
                                    Pantang menyerah, kreatif, serta tekun mengasah potensi keilmuan.
                                </p>
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
                            <a href="/visi-misi-motto" class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 text-blue-600 font-extrabold">
                                <span>Visi, Misi & Motto</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/program-unggulan" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Program Unggulan</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
