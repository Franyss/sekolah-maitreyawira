{{-- File: resources/views/fasilitas.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas Sekolah | Maitreyawira Palembang</title>

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
                <span class="text-amber-400">Fasilitas</span>
            </nav>

            <div class="max-w-3xl space-y-4">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                    Sarana & Prasarana
                </span>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    Fasilitas Modern & Asri <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500">
                        Sekolah Maitreyawira Palembang
                    </span>
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Lingkungan belajar yang aman, nyaman, dan dilengkapi sarana penunjang modern untuk mendukung perkembangan akademis, seni, serta karakter murid.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- INTRO KAMPUS -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4" data-aos="fade-up" data-aos-delay="100">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-2xl font-black text-slate-900">Sarana Penunjang Pendidikan Terpadu</h2>
                    <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Lingkungan Kondusif, Nyaman & Asri</p>
                </div>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Kampus Sekolah Maitreyawira Palembang dirancang dengan konsep ramah lingkungan dan penuh penghijauan. Setiap fasilitas dirawat secara berkala untuk memastikan kenyamanan dan keselamatan seluruh peserta didik dari jenjang TK hingga SMA.
                </p>
            </div>

            <!-- GRID DAFTAR FASILITAS (DATA DINAMIS DATABASE) -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($facilities as $facility)
                    @php
                        $photo = trim($facility->facility_photo ?? '');
                        $fileName = basename($photo);

                        // Jalur gambar lokal vs server resmi
                        if (!empty($fileName) && file_exists(public_path('uploads/facility/' . $fileName))) {
                            $imgUrl = asset('uploads/facility/' . $fileName);
                        } elseif (!empty($fileName) && file_exists(public_path('storage/facility/' . $fileName))) {
                            $imgUrl = asset('storage/facility/' . $fileName);
                        } elseif (!empty($fileName)) {
                            $imgUrl = 'https://maitreyawira-palembang.sch.id/uploads/facility/' . $fileName;
                        } else {
                            $imgUrl = 'https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=800&q=80';
                        }
                    @endphp

                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between group"
                         data-aos="fade-up" data-aos-delay="{{ 100 + ($loop->index % 3) * 100 }}">
                        <div>
                            {{-- GAMBAR FASILITAS --}}
                            <div class="h-48 overflow-hidden bg-slate-100 relative">
                                <img src="{{ $imgUrl }}"
                                     alt="{{ $facility->facility_title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='https://maitreyawira-palembang.sch.id/uploads/facility/{{ $fileName }}';">
                            </div>

                            {{-- DESKRIPSI FASILITAS --}}
                            <div class="p-6 space-y-3">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition">
                                    {{ $facility->facility_title }}
                                </h3>
                                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                    {{ $facility->facility_desc }}
                                </p>
                            </div>
                        </div>

                        {{-- TAMPILKAN RINCIAN JIKA ADA KONTEN DETAIL --}}
                        @if($facility->details->count() > 0)
                            <div class="px-6 pb-6 pt-2 border-t border-slate-100 mt-auto">
                                @foreach($facility->details as $detail)
                                    @if($detail->facility_detail_desc)
                                        <p class="text-xs text-slate-500 italic">
                                            {{ $detail->facility_detail_desc }}
                                        </p>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    {{-- FALLBACK DATA RESMI JIKA DATABASE MASIH KOSONG --}}
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                        <img src="https://maitreyawira-palembang.sch.id/uploads/facility/fasilitas-thumbnail-20210302140814.jpeg" alt="Galeri Edukasi dan Budaya Cinta Alam" class="w-full h-48 object-cover">
                        <div class="p-6 space-y-2">
                            <h3 class="text-lg font-bold text-slate-900">Galeri Edukasi dan Budaya Cinta Alam</h3>
                            <p class="text-slate-600 text-xs leading-relaxed">Galeri Edukasi dan Budaya Cinta Alam memvisualisasikan visi dan budaya cinta alam sekolah.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm" data-aos="fade-up" data-aos-delay="200">
                        <img src="https://maitreyawira-palembang.sch.id/uploads/facility/fasilitas-thumbnail-20210302140831.jpg" alt="Galeri Nusantara" class="w-full h-48 object-cover">
                        <div class="p-6 space-y-2">
                            <h3 class="text-lg font-bold text-slate-900">Galeri Nusantara</h3>
                            <p class="text-slate-600 text-xs leading-relaxed">Galeri Nusantara untuk selalu mengingatkan akan pentingnya cinta tanah air dan keanekaragaman budaya.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm" data-aos="fade-up" data-aos-delay="300">
                        <img src="https://maitreyawira-palembang.sch.id/uploads/facility/fasilitas-thumbnail-20210302140843.jpg" alt="Kantin Sehat" class="w-full h-48 object-cover">
                        <div class="p-6 space-y-2">
                            <h3 class="text-lg font-bold text-slate-900">Kantin Sehat</h3>
                            <p class="text-slate-600 text-xs leading-relaxed">Melalui kantin sehat seluruh warga sekolah diharapkan dapat menikmati konsumsi vegetaris yang higienis dan bergizi.</p>
                        </div>
                    </div>
                @endforelse
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
