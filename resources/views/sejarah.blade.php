{{-- File: resources/views/sejarah.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah Sekolah | Maitreyawira Palembang</title>

    {{-- CSS AOS & Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-16 sm:py-20">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down" data-aos-duration="1000">
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <span class="text-slate-300">Tentang Kami</span>
                <span>/</span>
                <span class="text-amber-400">Sejarah</span>
            </nav>

            <div class="max-w-3xl space-y-4">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                    Profil Lembaga
                </span>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    Sejarah Singkat <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500">
                        Sekolah Maitreyawira Palembang
                    </span>
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Perjalanan tumbuh dan berkembangnya institusi pendidikan yang berlandaskan kasih alam, moralitas luhur, dan keunggulan akademik di Kota Palembang.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA (FULL-WIDTH CENTERED) --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <main class="space-y-10">

                <!-- Latar Belakang Pendirian -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-2xl font-black text-slate-900">Awal Mula Pendirian</h2>
                        <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Latar Belakang & Cita-Cita Luhur</p>
                    </div>

                    <div class="grid md:grid-cols-12 gap-6 items-center">
                        <div class="md:col-span-7 prose prose-slate text-slate-600 text-sm sm:text-base leading-relaxed space-y-4 max-w-none" data-aos="fade-right" data-aos-delay="200">
                            <p>
                                Perintisan Sekolah Maitreyawira Palembang yang berada di bawah naungan <strong>Yayasan Cahaya Maitreya Palembang</strong> berawal dari niat tulus Ibu Suni Cendrawasih dan para pengurus yayasan yang bercita-cita mendirikan sekolah berkarakter dan berkepribadian luhur.
                            </p>
                            <p>
                                Perintisan dimulai dari Pembukaan KB-TK Maitreyawira Palembang pada tanggal <strong>8 Agustus 2008</strong>.
                            </p>
                            <blockquote class="p-4 border-l-4 border-amber-400 bg-amber-50/50 rounded-r-xl italic text-slate-700 text-sm">
                                "Mendidik manusia tidak hanya mengasah kecerdasan otak, melainkan juga menghidupkan nurani dan karakter kasih di dalam jiwa setiap anak didik."
                            </blockquote>
                        </div>
                        <div class="md:col-span-5" data-aos="fade-left" data-aos-delay="300">
                            <img src="https://maitreyawira-palembang.sch.id/uploads/history/history-20210302092640.jpg"
                                 alt="Perintisan Sekolah Maitreyawira Palembang"
                                 class="w-full rounded-2xl shadow-md border border-slate-200 object-cover hover:scale-105 transition duration-300">
                        </div>
                    </div>
                </div>

                <!-- TIMELINE MILESTONE (Membaca DB + Memuat Gambar Server Resmi) -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-8" data-aos="fade-up" data-aos-delay="150">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">Jejak Langkah & Perkembangan</h2>
                        <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Milestone Penting Sekolah Maitreyawira Palembang</p>
                    </div>

                    <div class="relative border-l-2 border-blue-100 ml-4 space-y-10">
                        @forelse($histories as $history)
                            <div class="relative pl-8 group" data-aos="fade-up" data-aos-delay="{{ 100 + ($loop->index * 100) }}">
                                {{-- Marker Titik Warna --}}
                                <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full border-4 border-white shadow-xs group-hover:scale-125 transition"
                                     style="background-color: {{ $history->color ?? '#2563eb' }};">
                                </div>

                                {{-- Tanggal / Tahun --}}
                                <span class="px-2.5 py-1 rounded-md bg-blue-50 text-blue-700 font-black text-xs inline-block mb-2 border border-blue-100">
                                    {{ \Carbon\Carbon::parse($history->history_date)->translatedFormat('d F Y') }}
                                </span>

                                {{-- Judul Sejarah --}}
                                <h3 class="text-xl font-bold text-slate-900">{{ $history->history_title }}</h3>

                                {{-- Detail Deskripsi & Foto --}}
                                @foreach($history->details as $detail)
                                    <div class="mt-4 space-y-2">
                                        @if(!empty($detail->history_detail_photo))
                                            @php
                                                $photo = trim($detail->history_detail_photo);
                                                $fileName = basename($photo);

                                                if (file_exists(public_path('uploads/history/' . $fileName))) {
                                                    $imgUrl = asset('uploads/history/' . $fileName);
                                                } elseif (file_exists(public_path('storage/history/' . $fileName))) {
                                                    $imgUrl = asset('storage/history/' . $fileName);
                                                } else {
                                                    $imgUrl = 'https://maitreyawira-palembang.sch.id/uploads/history/' . $fileName;
                                                }
                                            @endphp

                                            <div class="overflow-hidden rounded-xl border border-slate-200 shadow-sm max-w-xl my-3">
                                                <img src="{{ $imgUrl }}"
                                                     alt="{{ $detail->history_detail_desc ?? $history->history_title }}"
                                                     class="w-full h-auto object-cover hover:scale-105 transition duration-300"
                                                     loading="lazy"
                                                     onerror="this.onerror=null; this.src='https://maitreyawira-palembang.sch.id/uploads/history/{{ $fileName }}';">
                                            </div>
                                        @endif

                                        @if(!empty($detail->history_detail_desc))
                                            <p class="text-sm text-slate-600 leading-relaxed">
                                                {{ $detail->history_detail_desc }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <div class="p-6 text-center text-slate-400 italic bg-slate-50 rounded-xl border border-dashed border-slate-200">
                                Belum ada data sejarah yang dicatat di database.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- NILAI UTAMA MAITREYAWIRA -->
                <div class="bg-gradient-to-br from-blue-900 to-slate-900 text-white rounded-2xl p-8 shadow-xl space-y-6" data-aos="zoom-in" data-aos-delay="200">
                    <h2 class="text-2xl font-black">Nilai Historis yang Terus Dijaga</h2>
                    <div class="grid sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                        <div class="bg-slate-800/60 p-4 rounded-xl border border-slate-700/60" data-aos="fade-right" data-aos-delay="300">
                            <div class="text-amber-400 font-extrabold mb-1">🌿 Kasih Alam</div>
                            <p class="text-slate-300">Menanamkan kesadaran menjaga kelestarian lingkungan dan menyayangi sesama makhluk hidup.</p>
                        </div>
                        <div class="bg-slate-800/60 p-4 rounded-xl border border-slate-700/60" data-aos="fade-left" data-aos-delay="300">
                            <div class="text-amber-400 font-extrabold mb-1">🎓 Keunggulan Akademik</div>
                            <p class="text-slate-300">Memadukan kurikulum nasional dan penguasaan bahasa asing serta teknologi informasi.</p>
                        </div>
                    </div>
                </div>

            </main>
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
