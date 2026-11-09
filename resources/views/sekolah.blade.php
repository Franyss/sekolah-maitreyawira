{{-- File: resources/views/sekolah.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $school->sch_name }} | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS Library & Asset Vite / Tailwind CDN --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. NAVBAR PARTIAL --}}
    @if(View::exists('partials.navbar'))
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

    {{-- 2. HERO BANNER --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-14 sm:py-20 min-h-[260px] flex items-center"
             style="@if(!empty($school->sch_background_header)) background-image: url('{{ asset('storage/' . $school->sch_background_header) }}'); background-size: cover; background-position: center; @endif">

        <!-- Overlay Gelap Gradient -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/95 to-slate-900/90 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full" data-aos="fade-down" data-aos-duration="1000">
            <!-- Navigasi Breadcrumb -->
            <nav class="flex text-xs font-semibold text-slate-300 mb-3 gap-2 items-center">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <span class="text-slate-400">Sekolah</span>
                <span>/</span>
                <span class="text-amber-400 font-bold">{{ $school->sch_name }}</span>
            </nav>

            <!-- Badge Kategori -->
            <div class="mb-3">
                <span class="inline-block px-3.5 py-1 rounded-full text-[11px] font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-wider">
                    PROFIL UNIT SEKOLAH
                </span>
            </div>

            <!-- Judul Utama -->
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                <span class="text-white block">Profil & Informasi</span>
                <span class="text-amber-400">
                    {{ $school->sch_name }}
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="text-slate-300 text-xs sm:text-sm mt-3 max-w-2xl leading-relaxed">
                Mewujudkan pendidikan berkualitas yang berlandaskan kasih alam, moralitas luhur, dan keunggulan akademik di Sekolah Maitreyawira Palembang.
            </p>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA & INFORMASI KONTAK UNIT --}}
    <section class="py-12 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">

                <!-- KONTEN UTAMA: Sambutan & Profil Sekolah (8 Kolom) -->
                <main class="lg:col-span-8 space-y-6">
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up" data-aos-delay="100">

                        <!-- Gambar Utama Unit Sekolah (sch_img) -->
                        @if(!empty($school->sch_img))
                            <div class="overflow-hidden rounded-xl border border-slate-100 shadow-xs max-h-[380px]" data-aos="zoom-in" data-aos-delay="200">
                                <img src="{{ asset('storage/' . $school->sch_img) }}"
                                     alt="{{ $school->sch_name }}"
                                     class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            </div>
                        @endif

                        <div class="border-b border-slate-100 pb-3">
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900">
                                Profil & Kata Sambutan {{ $school->sch_name }}
                            </h2>
                        </div>

                        <!-- Isi Sambutan / Deskripsi (sch_opening_speech) -->
                        <div class="prose prose-slate max-w-none text-slate-700 text-xs sm:text-sm leading-relaxed space-y-4" data-aos="fade-up" data-aos-delay="300">
                            @if(!empty($school->sch_opening_speech))
                                {!! $school->sch_opening_speech !!}
                            @else
                                <p class="text-slate-400 italic">Belum ada deskripsi sambutan untuk unit sekolah ini.</p>
                            @endif
                        </div>

                        <!-- Tombol Pendaftaran Langsung -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between" data-aos="fade-up" data-aos-delay="350">
                            <span class="text-xs font-bold text-slate-500">Tertarik bergabung dengan {{ $school->sch_name }}?</span>
                            <a href="{{ route('pendaftaran-siswa.index') }}"
                               class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2 transform hover:-translate-y-0.5">
                                <i class="fa-solid fa-user-plus"></i>
                                <span>Daftar Sekarang</span>
                            </a>
                        </div>

                    </div>
                </main>

                <!-- SIDEBAR INFORMASI KONTAK UNIT (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- Kartu Informasi Kontak Unit -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-5">
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                            <i class="fa-solid fa-building text-blue-600"></i> Kontak Unit {{ $school->sch_name }}
                        </h3>

                        <div class="space-y-4 text-xs text-slate-700">
                            <!-- Alamat Sekolah (sch_address) -->
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0">
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
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm shrink-0">
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

                </aside>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @if(View::exists('partials.footer'))
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
