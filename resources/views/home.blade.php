{{-- File: resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Maitreyawira Palembang | Official Website</title>

    {{-- CSS AOS & Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')

    {{-- Alpine.js & Typed.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden">

    {{-- 1. PANGGIL PARTIAL NAVBAR --}}
    @include('partials.navbar')

    {{-- 2. HERO SLIDER SECTION (FULL-WIDTH EDGE-TO-EDGE STYLE ITB) --}}
    <section class="relative w-full bg-slate-900 overflow-hidden">

        @php
            $totalSlides = (isset($sliders) && $sliders->count() > 0) ? $sliders->count() : 2;
        @endphp

        <!-- SLIDER CONTAINER RESPONSIF EDGE-TO-EDGE -->
        <div x-data="{
                activeSlide: 1,
                totalSlides: {{ $totalSlides }},
                next() { this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1 },
                prev() { this.activeSlide = this.activeSlide === 1 ? this.totalSlides : this.activeSlide - 1 }
             }"
             x-init="setInterval(() => { next() }, 7000)"
             class="relative w-full h-[450px] sm:h-[550px] lg:h-[650px] overflow-hidden group">

            @if(isset($sliders) && $sliders->count() > 0)
                {{-- ITERASI DINAMIS DARI DATABASE app_slider --}}
                @foreach($sliders as $index => $slider)
                    @php
                        $slideNum = $index + 1;
                        $photo = trim($slider->photo ?? '');
                        $fileName = basename($photo);

                        if (empty($photo)) {
                            $imgUrl = asset('images/slider-ppdb.jpg');
                        } elseif (str_starts_with($photo, 'http://') || str_starts_with($photo, 'https://')) {
                            $imgUrl = $photo;
                        } elseif (str_starts_with($photo, 'uploads/')) {
                            $imgUrl = file_exists(public_path('storage/' . $photo)) ? asset('storage/' . $photo) : asset($photo);
                        } else {
                            if (file_exists(public_path('storage/uploads/app_slider/' . $fileName))) {
                                $imgUrl = asset('storage/uploads/app_slider/' . $fileName);
                            } elseif (file_exists(public_path('uploads/app_slider/' . $fileName))) {
                                $imgUrl = asset('uploads/app_slider/' . $fileName);
                            } elseif (file_exists(public_path('uploads/slider/' . $fileName))) {
                                $imgUrl = asset('uploads/slider/' . $fileName);
                            } elseif (file_exists(public_path('images/' . $fileName))) {
                                $imgUrl = asset('images/' . $fileName);
                            } else {
                                $imgUrl = asset('storage/uploads/app_slider/' . $fileName);
                            }
                        }
                    @endphp

                    <div x-show="activeSlide === {{ $slideNum }}"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 scale-105"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-500"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0 w-full h-full z-10"
                         @if($slideNum > 1) style="display: none;" @endif>

                        <div class="relative w-full h-full">
                            <!-- GAMBAR SLIDER (FULL MEMANJANG KIRI KANAN) -->
                            <a href="{{ $slider->btn_link ?: '#' }}" class="block w-full h-full">
                                <img src="{{ $imgUrl }}"
                                     alt="{{ $slider->title ?? 'Slider Sekolah Maitreyawira' }}"
                                     class="w-full h-full object-cover object-center"
                                     onerror="this.onerror=null; this.src='{{ asset('images/slider-ppdb.jpg') }}';">
                            </a>

                            <!-- OVERLAY TEKS -->
                            @if(!empty($slider->title) || !empty($slider->description))
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/60 to-transparent pointer-events-none">
                                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                                        <div class="max-w-2xl space-y-3 sm:space-y-4 pointer-events-auto">

                                            @if(!empty($slider->title))
                                                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white leading-tight drop-shadow-md">
                                                    {{ $slider->title }}
                                                </h2>
                                            @endif

                                            {{-- ANIMASI KETIK DESKRIPSI --}}
                                            @if(!empty($slider->description))
                                                <p x-data="{
                                                        fullText: @js(strip_tags($slider->description)),
                                                        displayedText: '',
                                                        timer: null,
                                                        startTyping() {
                                                            clearInterval(this.timer);
                                                            this.displayedText = '';
                                                            let i = 0;
                                                            this.timer = setInterval(() => {
                                                                if (i < this.fullText.length) {
                                                                    this.displayedText += this.fullText.charAt(i);
                                                                    i++;
                                                                } else {
                                                                    clearInterval(this.timer);
                                                                }
                                                            }, 30);
                                                        }
                                                   }"
                                                   x-init="
                                                        if (activeSlide === {{ $slideNum }}) { startTyping(); }
                                                        $watch('activeSlide', val => {
                                                            if (val === {{ $slideNum }}) { startTyping(); }
                                                        });
                                                   "
                                                   class="text-amber-300 text-sm sm:text-base leading-relaxed hidden sm:block font-medium drop-shadow-sm min-h-[2.5rem]">
                                                    <span x-text="displayedText"></span>
                                                    <span x-show="displayedText.length < fullText.length" class="inline-block w-0.5 h-4 bg-amber-400 animate-pulse ml-0.5 align-middle"></span>
                                                </p>
                                            @endif

                                            @if(!empty($slider->btn_text) && !empty($slider->btn_link))
                                                <div class="pt-2 sm:pt-4">
                                                    <a href="{{ $slider->btn_link }}" class="inline-flex items-center gap-2 px-6 py-3 bg-amber-400 hover:bg-amber-300 text-slate-950 font-black text-xs sm:text-sm rounded-xl shadow-lg transition duration-200">
                                                        <span>{{ $slider->btn_text }}</span>
                                                        <span>&rarr;</span>
                                                    </a>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                {{-- FALLBACK STATIS SLIDER FULL WIDTH --}}
                <div x-show="activeSlide === 1" class="absolute inset-0 w-full h-full z-10">
                    <a href="/pendaftaran-siswa" class="block w-full h-full">
                        <img src="{{ asset('images/slider-ppdb.jpg') }}" alt="Banner PPDB" class="w-full h-full object-cover">
                    </a>
                </div>
                <div x-show="activeSlide === 2" class="absolute inset-0 w-full h-full z-10" style="display: none;">
                    <div class="relative w-full h-full">
                        <img src="{{ asset('images/slider-anak.jpg') }}" alt="Aktivitas Siswa" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/60 to-transparent">
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                                <div class="max-w-2xl space-y-4">
                                    <span class="inline-block px-3.5 py-1 bg-amber-400 text-[#1b2a6b] font-black text-xs rounded-full uppercase tracking-wider">
                                        Visi & Komitmen Pendidikan
                                    </span>
                                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                                        Mendidik Generasi yang <br>
                                        <span id="typed-text" class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500 border-r-2 border-amber-400 pr-1"></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- PANAH NAVIGASI DI UJUNG KIRI & KANAN LAYAR -->
            <button type="button"
                    @click.prevent="prev()"
                    class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-slate-900/60 hover:bg-amber-400 hover:text-slate-950 text-white flex items-center justify-center backdrop-blur-md transition duration-300 shadow-xl z-30 cursor-pointer">
                ❮
            </button>
            <button type="button"
                    @click.prevent="next()"
                    class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-slate-900/60 hover:bg-amber-400 hover:text-slate-950 text-white flex items-center justify-center backdrop-blur-md transition duration-300 shadow-xl z-30 cursor-pointer">
                ❯
            </button>

            <!-- INDIKATOR DOTS -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 z-30 bg-slate-900/60 backdrop-blur-md px-4 py-2 rounded-full border border-white/20">
                @if(isset($sliders) && $sliders->count() > 0)
                    @foreach($sliders as $index => $slider)
                        <button type="button"
                                @click.prevent="activeSlide = {{ $index + 1 }}"
                                :class="activeSlide === {{ $index + 1 }} ? 'bg-amber-400 w-8' : 'bg-white/60 hover:bg-white w-2.5'"
                                class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                    @endforeach
                @else
                    <button type="button" @click.prevent="activeSlide = 1" :class="activeSlide === 1 ? 'bg-amber-400 w-8' : 'bg-white/60 hover:bg-white w-2.5'" class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                    <button type="button" @click.prevent="activeSlide = 2" :class="activeSlide === 2 ? 'bg-amber-400 w-8' : 'bg-white/60 hover:bg-white w-2.5'" class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                @endif
            </div>

        </div>
    </section>

    {{-- 4. JENJANG PENDIDIKAN --}}
    <section id="jenjang" class="py-16 sm:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3" data-aos="fade-up">
                <span class="text-[#1b2a6b] font-extrabold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                    Program Pendidikan
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Pilih Jenjang Pendidikan Untuk Buah Hati Anda
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Kurikulum terintegrasi yang menitikberatkan pada pembentukan insan berintegritas, cerdas secara akademik, dan berbudaya kasih alam.
                </p>
            </div>

            @php
                $getLogoUrl = function($key, $default) use ($configs) {
                    $val = trim($configs[$key] ?? '');
                    if (empty($val)) return asset($default);
                    if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) return $val;
                    if (file_exists(public_path('storage/' . $val))) return asset('storage/' . $val);
                    if (file_exists(public_path($val))) return asset($val);
                    if (file_exists(public_path('uploads/app_config/' . basename($val)))) return asset('uploads/app_config/' . basename($val));
                    return asset('storage/' . $val);
                };
            @endphp

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- TK -->
                <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 flex flex-col justify-between text-center group"
                     data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="w-20 h-20 mb-6 mx-auto flex items-center justify-center p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm group-hover:scale-110 transition duration-300 overflow-hidden">
                            <img src="{{ $getLogoUrl('app_logo_tk', 'images/logo-tk-maitreyawira.jpg') }}"
                                 alt="Logo TK Maitreyawira"
                                 class="w-full h-full object-contain rounded-full"
                                 onerror="this.onerror=null; this.src='{{ asset('images/logo-tk-maitreyawira.jpg') }}';">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-[#1b2a6b] transition">Taman Kanak-Kanak</h3>
                        <p class="text-slate-600 text-xs leading-relaxed mb-6">
                            {!! strip_tags($configs['app_content_sch_tk'] ?? 'Menanamkan kebiasaan positif, kemandirian awal, serta kecintaan belajar melalui metode eksplorasi yang menyenangkan.') !!}
                        </p>
                    </div>
                    <a href="/sekolah/kb-tk-maitreyawira" class="text-[#1b2a6b] font-bold text-xs inline-flex items-center justify-center gap-2 group-hover:translate-x-1 transition">
                        <span>Detail Program TK</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>

                <!-- SD -->
                <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 flex flex-col justify-between text-center group"
                     data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="w-20 h-20 mb-6 mx-auto flex items-center justify-center p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm group-hover:scale-110 transition duration-300 overflow-hidden">
                            <img src="{{ $getLogoUrl('app_logo_sd', 'images/logo-sd-maitreyawira.jpg') }}"
                                 alt="Logo SD Maitreyawira"
                                 class="w-full h-full object-contain rounded-full"
                                 onerror="this.onerror=null; this.src='{{ asset('images/logo-sd-maitreyawira.jpg') }}';">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-[#1b2a6b] transition">Sekolah Dasar</h3>
                        <p class="text-slate-600 text-xs leading-relaxed mb-6">
                            {!! strip_tags($configs['app_content_sch_sd'] ?? 'Pondasi kuat literasi, numerasi, pemahaman nilai-nilai etika, bahasa asing, serta kepedulian lingkungan.') !!}
                        </p>
                    </div>
                    <a href="/sekolah/sd-maitreyawira" class="text-[#1b2a6b] font-bold text-xs inline-flex items-center justify-center gap-2 group-hover:translate-x-1 transition">
                        <span>Detail Program SD</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>

                <!-- SMP -->
                <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 flex flex-col justify-between text-center group"
                     data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="w-20 h-20 mb-6 mx-auto flex items-center justify-center p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm group-hover:scale-110 transition duration-300 overflow-hidden">
                            <img src="{{ $getLogoUrl('app_logo_smp', 'images/logo-smp-maitreyawira.jpg') }}"
                                 alt="Logo SMP Maitreyawira"
                                 class="w-full h-full object-contain rounded-full"
                                 onerror="this.onerror=null; this.src='{{ asset('images/logo-smp-maitreyawira.jpg') }}';">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-[#1b2a6b] transition">Sekolah Menengah Pertama</h3>
                        <p class="text-slate-600 text-xs leading-relaxed mb-6">
                            {!! strip_tags($configs['app_content_sch_smp'] ?? 'Pengembangan bakat, logika sains, penguasaan teknologi informasi, kepemimpinan, dan kegiatan ekstrakurikuler.') !!}
                        </p>
                    </div>
                    <a href="/sekolah/smp-maitreyawira" class="text-[#1b2a6b] font-bold text-xs inline-flex items-center justify-center gap-2 group-hover:translate-x-1 transition">
                        <span>Detail Program SMP</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>

                <!-- SMA -->
                <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 flex flex-col justify-between text-center group"
                     data-aos="fade-up" data-aos-delay="400">
                    <div>
                        <div class="w-20 h-20 mb-6 mx-auto flex items-center justify-center p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm group-hover:scale-110 transition duration-300 overflow-hidden">
                            <img src="{{ $getLogoUrl('app_logo_sma', 'images/logo-sma-maitreyawira.jpg') }}"
                                 alt="Logo SMA Maitreyawira"
                                 class="w-full h-full object-contain rounded-full"
                                 onerror="this.onerror=null; this.src='{{ asset('images/logo-sma-maitreyawira.jpg') }}';">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-[#1b2a6b] transition">Sekolah Menengah Atas</h3>
                        <p class="text-slate-600 text-xs leading-relaxed mb-6">
                            {!! strip_tags($configs['app_content_sch_sma'] ?? 'Persiapan matang menuju Perguruan Tinggi ternama, riset ilmiah, jiwa wirausaha, serta kematangan moral.') !!}
                        </p>
                    </div>
                    <a href="/sekolah/sma-maitreyawira" class="text-[#1b2a6b] font-bold text-xs inline-flex items-center justify-center gap-2 group-hover:translate-x-1 transition">
                        <span>Detail Program SMA</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. BANNER TUR VIRTUAL & SEJARAH SEKOLAH --}}
    @php
        $rawVideoUrl = trim($configs['app_content_url_video_tour'] ?? '');
        $youtubeId = 'Igx7Jwnn8oc';

        if (!empty($rawVideoUrl)) {
            if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/))([\w-]{11})/', $rawVideoUrl, $matches)) {
                $youtubeId = $matches[1];
            }
        }

        $watchUrl = "https://www.youtube.com/watch?v={$youtubeId}";
        $thumbnailUrl = "https://i.ytimg.com/vi/{$youtubeId}/hqdefault.jpg";
        $fallbackLocalImg = asset('images/slider-ppdb.jpg');
    @endphp

    <section id="sejarah" class="py-12 sm:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-slate-950 border border-slate-800" data-aos="zoom-in" data-aos-duration="1000">
                <div class="absolute inset-0 z-0">
                    <img src="{{ $thumbnailUrl }}"
                         alt="Background Tur Sekolah"
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null; this.src='{{ $fallbackLocalImg }}';">
                    <div class="absolute inset-0 bg-slate-950/75 backdrop-blur-[1px]"></div>
                </div>

                <div class="relative z-10 px-6 sm:px-12 py-16 sm:py-20 text-white flex flex-col items-center justify-center text-center min-h-[420px]">
                    <div class="space-y-3 max-w-4xl mx-auto" data-aos="fade-down" data-aos-delay="200">
                        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black uppercase tracking-wider text-white drop-shadow-lg">
                            {!! strip_tags($configs['app_content_video_tour_title1'] ?? 'VIDEO TUR SEKOLAH TERCINTA KAMI') !!}
                        </h2>
                        <p class="text-slate-100 text-xs sm:text-sm font-medium max-w-xl mx-auto drop-shadow-md">
                            {!! strip_tags($configs['app_set_title_sch'] ?? 'Yuk lihat sekolah kami melalui video tur sekolah berikut ini.') !!}
                        </p>
                    </div>

                    <div class="mt-8 mb-4" data-aos="zoom-in" data-aos-delay="300">
                        <a href="{{ $watchUrl }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           title="Mulai Tur Virtual"
                           class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-[#5054d6] hover:bg-[#4347c7] text-slate-950 shadow-2xl hover:scale-110 transition duration-300 cursor-pointer group border-2 border-indigo-400/30">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 fill-slate-950 translate-x-0.5 group-hover:scale-105 transition duration-200" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. SEKSI BERITA & ARTIKEL --}}
    <section id="berita" class="py-20 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-end mb-12 gap-4" data-aos="fade-up">
                <div>
                    <span class="text-blue-600 font-extrabold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                        Pusat Warta & Informasi
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2">
                        Berita & Kegiatan Terbaru
                    </h2>
                </div>
                <a href="/berita" class="px-5 py-2.5 bg-white hover:bg-slate-100 text-blue-600 font-bold text-xs rounded-xl border border-slate-200 shadow-sm transition flex items-center gap-2">
                    <span>Lihat Semua Berita</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if(isset($latestNews) && $latestNews->count() > 0)
                    @foreach($latestNews as $index => $item)
                        @php
                            $thumb = trim($item->thumbnail ?? '');
                            $fileName = basename($thumb);

                            if (!empty($fileName) && file_exists(public_path('uploads/post/' . $fileName))) {
                                $imgUrl = asset('uploads/post/' . $fileName);
                            } elseif (!empty($fileName) && file_exists(public_path('storage/post/' . $fileName))) {
                                $imgUrl = asset('storage/post/' . $fileName);
                            } elseif (!empty($thumb) && str_starts_with($thumb, 'http')) {
                                $imgUrl = $thumb;
                            } else {
                                $imgUrl = 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&w=600&q=80';
                            }

                            $delay = ($index + 1) * 100;
                            $formattedDate = \Carbon\Carbon::parse($item->datetime_created)->translatedFormat('d F Y');
                        @endphp

                        <article class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between group"
                                 data-aos="fade-up" data-aos-delay="{{ $delay }}">
                            <div>
                                <div class="h-44 bg-slate-100 flex items-center justify-center text-slate-400 font-medium relative overflow-hidden">
                                    <img src="{{ $imgUrl }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                         loading="lazy">

                                    @if($item->tags && $item->tags->count() > 0)
                                        <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">
                                            #{{ $item->tags->first()->post_tag_name }}
                                        </span>
                                    @else
                                        <span class="absolute top-3 left-3 bg-slate-900/80 text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm">
                                            Berita
                                        </span>
                                    @endif
                                </div>

                                <div class="p-5">
                                    <div class="text-[11px] text-slate-400 font-medium mb-2 flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar text-amber-500"></i>
                                        <span>{{ $formattedDate }}</span>
                                    </div>
                                    <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug group-hover:text-blue-600 transition line-clamp-2 mb-2" title="{{ $item->title }}">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-slate-600 text-xs line-clamp-3 leading-relaxed">
                                        {{ Str::limit(strip_tags($item->content), 90) }}
                                    </p>
                                </div>
                            </div>

                            <div class="px-5 pb-5 pt-1">
                                <a href="/berita/{{ $item->slug }}" class="text-blue-600 font-extrabold text-xs hover:underline inline-flex items-center gap-1">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-slate-200">
                        <p class="text-slate-500 text-sm font-medium">Belum ada berita atau artikel yang dipublikasikan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- 7. SEKSI KHUSUS PRESTASI TERKINI (KONSISTEN DENGAN TEMA TERANG HALAMAN APLIKASI) --}}
    <section id="prestasi" class="py-20 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-end mb-12 gap-4" data-aos="fade-up">
                <div>
                    <span class="text-amber-600 font-extrabold text-xs uppercase tracking-widest bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                        🏆 Bangga Maitreyawira
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2">
                        Prestasi & Penghargaan Siswa/i
                    </h2>
                </div>
            </div>

            <!-- GRID 2 KOLOM KHUSUS UNTUK 2 ACHIEVEMENT TERBARU -->
            <div class="grid md:grid-cols-2 gap-8">
                @if(isset($latestAchievements) && $latestAchievements->count() > 0)
                    @foreach($latestAchievements as $index => $achieve)
                        @php
                            $delay = ($index + 1) * 150;
                            $formattedDate = \Carbon\Carbon::parse($achieve->datetime_created)->translatedFormat('d F Y');
                        @endphp

                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 flex flex-col justify-between group"
                             data-aos="fade-up" data-aos-delay="{{ $delay }}">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl font-bold border border-amber-200/60 group-hover:scale-110 transition duration-300">
                                        <i class="fa-solid fa-trophy"></i>
                                    </div>
                                    <span class="text-[11px] text-slate-400 font-medium flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar text-amber-500"></i>
                                        {{ $formattedDate }}
                                    </span>
                                </div>

                                <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-blue-600 transition leading-snug line-clamp-2">
                                    {{ $achieve->achievement_title }}
                                </h3>

                                <div class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-3">
                                    {!! strip_tags($achieve->achievement_content) !!}
                                </div>
                            </div>

                            <div class="pt-6 mt-4 border-t border-slate-100">
                                <a href="/berita/{{ $achieve->achievement_slug }}" class="text-xs font-extrabold text-blue-600 hover:text-blue-800 transition inline-flex items-center gap-1.5">
                                    <span>Lihat Detail Kebanggaan</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-slate-200 text-slate-400 text-xs italic">
                        Belum ada catatan prestasi terbaru yang ditambahkan.
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- 8. FOOTER LENGKAP --}}
    @include('partials.footer')

    {{-- SCRIPT INISIALISASI TYPED.JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('typed-text')) {
                new Typed('#typed-text', {
                    strings: [
                        'Berkarakter Kasih',
                        'Unggul & Cerdas',
                        'Berbudaya Pekerti Luhur',
                        'Mewujudkan Keindahan Kodrati'
                    ],
                    typeSpeed: 60,
                    backSpeed: 40,
                    backDelay: 2000,
                    loop: true
                });
            }
        });
    </script>

    {{-- SCRIPT INISIALISASI AOS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 120,
                easing: 'ease-out-cubic'
            });
        });
    </script>
</body>
</html>
