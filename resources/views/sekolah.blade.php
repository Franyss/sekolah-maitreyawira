{{-- File: resources/views/sekolah.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $school->sch_name }} | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS Library, FontAwesome & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. NAVBAR PARTIAL --}}
    @if (View::exists('partials.navbar'))
        @include('partials.navbar')
    @else
        <header class="bg-white border-b border-slate-200 py-4 px-6 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="/" class="font-black text-blue-900 tracking-tight text-lg">
                    SEKOLAH MAITREYAWIRA <span class="text-amber-500">PALEMBANG</span>
                </a>
            </div>
        </header>
    @endif

    {{-- 2. HERO BANNER SEKOLAH (DENGAN TINGGI RESPOSIF PROPORSI 1920 x 480 PX) --}}
    @php
        // Ambil data background header dari AppMenu (slug: sekolah) atau fallback dari data sekolah
        $menu = \App\Models\AppMenu::where('slug', 'sekolah')->first();
        $bgHeader = trim($menu->background_header ?? $school->sch_background_header ?? '');

        if (empty($bgHeader) || $bgHeader === '-') {
            $headerBgUrl = asset('images/slider-ppdb.jpg');
        } elseif (str_starts_with($bgHeader, 'http://') || str_starts_with($bgHeader, 'https://')) {
            $headerBgUrl = $bgHeader;
        } elseif (file_exists(public_path('storage/' . $bgHeader))) {
            $headerBgUrl = asset('storage/' . $bgHeader);
        } elseif (file_exists(public_path($bgHeader))) {
            $headerBgUrl = asset($bgHeader);
        } else {
            $headerBgUrl = asset('storage/' . $bgHeader);
        }

        $textColorClass = !empty($school->sch_font_color) ? $school->sch_font_color : 'text-white';

        // Definisi Variabel Teks Header Khusus Sekolah
        $badge = 'PROFIL UNIT SEKOLAH';
        $displayTitle = 'Profil & Informasi';
        $highlight = $school->sch_name ?? '';
    @endphp

    <section class="relative bg-slate-950 text-white overflow-hidden h-[300px] sm:h-[400px] lg:h-[480px] flex items-center">
        <!-- GAMBAR BACKGROUND HEADER -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $headerBgUrl }}" alt="{{ $school->sch_name }}"
                class="w-full h-full object-cover object-center"
                onerror="this.onerror=null; this.src='{{ asset('images/slider-ppdb.jpg') }}';">

            <!-- OVERLAY SLATE NETRAL -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/60 to-transparent z-10"></div>
        </div>

        <!-- KONTEN TEKS HERO & BREADCRUMB -->
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down" data-aos-duration="1000">
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center flex-wrap drop-shadow-sm">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <span class="text-slate-400">Sekolah</span>
                <span>/</span>
                <span class="text-amber-400 font-bold">{{ $school->sch_name }}</span>
            </nav>

            <div class="max-w-3xl space-y-4">
                @if (!empty($badge))
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-amber-500/10 text-amber-400 border border-amber-500/30 uppercase tracking-widest shadow-xs">
                        {{ $badge }}
                    </span>
                @endif

                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight {{ $textColorClass }} drop-shadow-lg">
                    {{ $displayTitle }}
                    @if (!empty($highlight))
                        <br>
                        <span class="text-amber-400 font-black drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">
                            {{ $highlight }}
                        </span>
                    @endif
                </h1>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA & INFORMASI KONTAK UNIT --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">

                <!-- KONTEN UTAMA: Sambutan & Profil Sekolah (8 Kolom) -->
                <main class="lg:col-span-8 space-y-6">
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6"
                        data-aos="fade-up" data-aos-delay="100">

                        <!-- Gambar Utama Unit Sekolah (sch_img) -->
                        @if (!empty($school->sch_img))
                            @php
                                $imgName = basename($school->sch_img);
                                if (file_exists(public_path('uploads/school/' . $imgName))) {
                                    $schImgUrl = asset('uploads/school/' . $imgName);
                                } elseif (file_exists(public_path('storage/' . $school->sch_img))) {
                                    $schImgUrl = asset('storage/' . $school->sch_img);
                                } else {
                                    $schImgUrl = asset('storage/' . $school->sch_img);
                                }
                            @endphp
                            <div class="overflow-hidden rounded-xl border border-slate-100 shadow-xs max-h-[380px]"
                                data-aos="zoom-in" data-aos-delay="200">
                                <img src="{{ $schImgUrl }}" alt="{{ $school->sch_name }}"
                                    class="w-full h-full object-cover hover:scale-105 transition duration-500"
                                    onerror="this.onerror=null; this.parentElement.style.display='none';">
                            </div>
                        @endif

                        <div class="border-b border-slate-100 pb-3">
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900">
                                Profil & Kata Sambutan {{ $school->sch_name }}
                            </h2>
                        </div>

                        <!-- Isi Sambutan / Deskripsi (sch_opening_speech) -->
                        <div class="prose prose-slate max-w-none text-slate-700 text-xs sm:text-sm leading-relaxed space-y-4"
                            data-aos="fade-up" data-aos-delay="300">
                            @if (!empty($school->sch_opening_speech))
                                {!! $school->sch_opening_speech !!}
                            @else
                                <p class="text-slate-400 italic">Belum ada deskripsi sambutan untuk unit sekolah ini.
                                </p>
                            @endif
                        </div>

                        <!-- Tombol Pendaftaran Langsung -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between" data-aos="fade-up"
                            data-aos-delay="350">
                            <span class="text-xs font-bold text-slate-500">Tertarik bergabung dengan
                                {{ $school->sch_name }}?</span>
                            <a href="{{ route('pendaftaran-siswa.index') }}"
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2 transform hover:-translate-y-0.5">
                                <i class="fa-solid fa-user-plus"></i>
                                <span>Daftar PPDB Sekarang</span>
                            </a>
                        </div>

                    </div>
                </main>

                <!-- SIDEBAR INFORMASI KONTAK UNIT (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- Kartu Informasi Kontak Unit -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-5">
                        <h3
                            class="text-xs font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                            <i class="fa-solid fa-building text-blue-600"></i> Kontak Unit {{ $school->sch_name }}
                        </h3>

                        <div class="space-y-4 text-xs text-slate-700">
                            <!-- Alamat Sekolah (sch_address) -->
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">Alamat Unit</h4>
                                    <p class="text-slate-600 text-xs mt-0.5 leading-relaxed">
                                        {{ $school->sch_address ?? 'Alamat belum diatur.' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Telepon Sekolah (sch_phone) -->
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">No. Telepon / Layanan</h4>
                                    <p class="text-slate-600 text-xs mt-0.5">
                                        {{ $school->sch_phone ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Widget Call-to-Action PPDB -->
                    <div
                        class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl p-6 text-slate-900 shadow-md space-y-4">
                        <div class="font-black text-lg leading-tight">
                            Bergabung Bersama Keluarga Maitreyawira!
                        </div>
                        <p class="text-xs text-slate-800 font-medium leading-relaxed">
                            Pendaftaran Murid Baru (PPDB) T.A 2026/2027 telah dibuka untuk jenjang TK, SD, SMP, dan SMA.
                        </p>
                        <a href="/pendaftaran-siswa"
                            class="inline-block w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-amber-400 font-extrabold text-xs text-center rounded-xl shadow-xs transition">
                            Daftar PPDB Online Sekarang
                        </a>
                    </div>

                </aside>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @if (View::exists('partials.footer'))
        @include('partials.footer')
    @else
        <footer class="bg-slate-900 text-slate-400 py-6 text-center text-xs border-t border-slate-800">
            <p>&copy; {{ date('Y') }} Sekolah Maitreyawira Palembang. All rights reserved.</p>
        </footer>
    @endif

    {{-- SCRIPT INISIALISASI ANIMASI AOS --}}
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
