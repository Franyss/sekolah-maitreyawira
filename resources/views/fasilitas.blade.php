{{-- File: resources/views/fasilitas.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas Sekolah | Maitreyawira Palembang</title>

    {{-- CSS AOS & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB (DINAMIS VIA BLADE COMPONENT <x-hero-banner>) --}}
    <x-hero-banner
        slug="fasilitas"
        badge="Sarana & Prasarana"
        title="Fasilitas Modern & Asri"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Tentang Kami', 'url' => '#'],
            ['label' => 'Fasilitas', 'url' => '']
        ]"
    />

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
                @if(!empty($facilities) && count($facilities) > 0)
                    @foreach($facilities as $index => $facility)
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
                             data-aos="fade-up" data-aos-delay="{{ 100 + ($index % 3) * 100 }}">
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
                            @if(isset($facility->details) && count($facility->details) > 0)
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
                    @endforeach
                @else
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
                @endif
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
