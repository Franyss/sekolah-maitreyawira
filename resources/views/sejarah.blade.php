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

    {{-- 2. HERO BANNER & BREADCRUMB (GUNAKAN TAG BLADE COMPONENT <x-hero-banner>) --}}
    <x-hero-banner
        slug="sejarah"
        badge="Profil Lembaga"
        title="Sejarah Singkat"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Tentang Kami', 'url' => '#'],
            ['label' => 'Sejarah', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN UTAMA --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <main class="space-y-10">

                <!-- Latar Belakang Pendirian -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Perintisan Sekolah Maitreyawira Palembang yang berada di bawah naungan <strong>Yayasan Cahaya Maitreya Palembang</strong> berawal dari niat tulus dari Ibu Suni Cendrawasih dan para pengurus yayasan yang bercita-cita mendirikan sebuah sekolah yang kelak dapat mendidik generasi muda untuk memiliki karakter dan kepribadian yang luhur. Perintisan sekolah dimulai dari Pembukaan KB-TK Maitreyawira Palembang pada tanggal <strong>8 Agustus 2008</strong>.
                    </p>
                </div>

                <!-- TIMELINE MILESTONE -->
                <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-8" data-aos="fade-up" data-aos-delay="150">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">Jejak Langkah & Perkembangan</h2>
                        <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Milestone Penting Sekolah Maitreyawira Palembang</p>
                    </div>

                    <div class="relative border-l-2 border-blue-100 ml-4 space-y-10">
                        @if(!empty($histories) && count($histories) > 0)
                            @foreach($histories as $history)
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
                                    @if(!empty($history->details) && count($history->details) > 0)
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
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="p-6 text-center text-slate-400 italic bg-slate-50 rounded-xl border border-dashed border-slate-200">
                                Belum ada data sejarah yang dicatat di database.
                            </div>
                        @endif
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
