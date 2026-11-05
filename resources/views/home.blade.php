{{-- File: resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Maitreyawira Palembang | Official Website</title>

    {{-- CSS AOS & Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')

    {{-- Alpine.js & Typed.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden">

    {{-- 1. PANGGIL PARTIAL NAVBAR --}}
    @include('partials.navbar')

    {{-- 2. HERO SLIDER SECTION (DINAMIS DARI TABEL app_slider) --}}
    <section class="relative bg-slate-100 py-4 sm:py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="zoom-in" data-aos-duration="1000">

            @php
                $totalSlides = (isset($sliders) && $sliders->count() > 0) ? $sliders->count() : 2;
            @endphp

            <!-- SLIDER CONTAINER RESPONSIF -->
            <div x-data="{
                    activeSlide: 1,
                    totalSlides: {{ $totalSlides }},
                    next() { this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1 },
                    prev() { this.activeSlide = this.activeSlide === 1 ? this.totalSlides : this.activeSlide - 1 }
                 }"
                 x-init="setInterval(() => { next() }, 7000)"
                 class="relative rounded-2xl overflow-hidden shadow-lg border border-slate-200 bg-slate-900 group">

                <!-- CONTAINER PROPOSIONAL -->
                <div class="relative w-full overflow-hidden">

                    <!-- GAMBAR PEMBANTU UNTUK PROPORSI RASIO BANNER -->
                    <img src="{{ asset('images/slider-ppdb.jpg') }}"
                         aria-hidden="true"
                         class="w-full h-auto opacity-0 pointer-events-none select-none block">

                    @if(isset($sliders) && $sliders->count() > 0)
                        {{-- ITERASI DINAMIS DARI DATABASE app_slider --}}
                        @foreach($sliders as $index => $slider)
                            @php
                                $slideNum = $index + 1;
                                $photo = trim($slider->photo ?? '');
                                $fileName = basename($photo);

                                // Penanganan URL Gambar Dinamis (Storage vs Public vs External)
                                if (empty($photo)) {
                                    $imgUrl = asset('images/slider-ppdb.jpg');
                                } elseif (str_starts_with($photo, 'http://') || str_starts_with($photo, 'https://')) {
                                    $imgUrl = $photo;
                                } elseif (str_starts_with($photo, 'uploads/')) {
                                    if (file_exists(public_path('storage/' . $photo))) {
                                        $imgUrl = asset('storage/' . $photo);
                                    } elseif (file_exists(public_path($photo))) {
                                        $imgUrl = asset($photo);
                                    } else {
                                        $imgUrl = asset('storage/' . $photo);
                                    }
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
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="absolute inset-0 w-full h-full z-10"
                                 @if($slideNum > 1) style="display: none;" @endif>

                                <div class="relative w-full h-full">
                                    <a href="{{ $slider->btn_link ?: '#' }}" class="block w-full h-full">
                                        <img src="{{ $imgUrl }}"
                                             alt="{{ $slider->title ?? 'Slider Sekolah Maitreyawira' }}"
                                             class="w-full h-full object-cover object-center"
                                             onerror="this.onerror=null; this.src='{{ asset('images/slider-ppdb.jpg') }}';">
                                    </a>

                                    @if(!empty($slider->title) || !empty($slider->description))
                                        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-950/50 to-transparent p-6 sm:p-12 md:p-16 flex items-center pointer-events-none">
                                            <div class="max-w-2xl space-y-3 sm:space-y-4 pointer-events-auto">

                                                @if(!empty($slider->title))
                                                    <h2 class="text-xl sm:text-3xl lg:text-4xl font-black text-white leading-tight">
                                                        {{ $slider->title }}
                                                    </h2>
                                                @endif

                                                {{-- ANIMASI KETIK UNTUK DESCRIPTION --}}
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
                                                       class="text-amber-300 text-xs sm:text-sm leading-relaxed hidden sm:block min-h-[2.5rem] font-medium">
                                                        <span x-text="displayedText"></span>
                                                        <span x-show="displayedText.length < fullText.length" class="inline-block w-0.5 h-4 bg-amber-400 animate-pulse ml-0.5 align-middle"></span>
                                                    </p>
                                                @endif

                                                @if(!empty($slider->btn_text) && !empty($slider->btn_link))
                                                    <div class="pt-1 sm:pt-2">
                                                        <a href="{{ $slider->btn_link }}" class="inline-block px-5 py-2 sm:px-6 sm:py-2.5 bg-[#1b2a6b] hover:bg-[#111c4e] text-white font-black text-xs rounded-xl shadow-md transition border border-blue-400/30">
                                                            {{ $slider->btn_text }} &rarr;
                                                        </a>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- FALLBACK STATIS JIKA DATABASE SLIDER KOSONG --}}
                        <div x-show="activeSlide === 1" class="absolute inset-0 w-full h-full z-10">
                            <a href="/pendaftaran-siswa" class="block w-full h-full">
                                <img src="{{ asset('images/slider-ppdb.jpg') }}" alt="Banner PPDB" class="w-full h-full object-cover">
                            </a>
                        </div>
                        <div x-show="activeSlide === 2" class="absolute inset-0 w-full h-full z-10" style="display: none;">
                            <div class="relative w-full h-full">
                                <img src="{{ asset('images/slider-anak.jpg') }}" alt="Aktivitas Siswa" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-950/50 to-transparent p-6 sm:p-12 md:p-16 flex items-center">
                                    <div class="max-w-2xl space-y-3 sm:space-y-4">
                                        <span class="inline-block px-3.5 py-1 bg-amber-400 text-[#1b2a6b] font-black text-xs rounded-full uppercase tracking-wider">
                                            Visi & Komitmen Pendidikan
                                        </span>
                                        <h2 class="text-xl sm:text-3xl lg:text-4xl font-black text-white leading-tight min-h-[3rem]">
                                            Mendidik Generasi yang <br>
                                            <span id="typed-text" class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500 border-r-2 border-amber-400 pr-1"></span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- NAVIGASI PANAH (PREV & NEXT) -->
                <button type="button"
                        @click.prevent="prev()"
                        class="absolute left-3 sm:left-5 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-slate-900/60 hover:bg-[#1b2a6b] text-white flex items-center justify-center backdrop-blur-md transition duration-300 shadow-md z-30 cursor-pointer">
                    ❮
                </button>
                <button type="button"
                        @click.prevent="next()"
                        class="absolute right-3 sm:right-5 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-slate-900/60 hover:bg-[#1b2a6b] text-white flex items-center justify-center backdrop-blur-md transition duration-300 shadow-md z-30 cursor-pointer">
                    ❯
                </button>

                <!-- INDIKATOR DOTS -->
                <div class="absolute bottom-3 sm:bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-2 z-30 bg-slate-900/60 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/20">
                    @if(isset($sliders) && $sliders->count() > 0)
                        @foreach($sliders as $index => $slider)
                            <button type="button"
                                    @click.prevent="activeSlide = {{ $index + 1 }}"
                                    :class="activeSlide === {{ $index + 1 }} ? 'bg-amber-400 w-7' : 'bg-white/60 hover:bg-white w-2.5'"
                                    class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                        @endforeach
                    @else
                        <button type="button" @click.prevent="activeSlide = 1" :class="activeSlide === 1 ? 'bg-amber-400 w-7' : 'bg-white/60 hover:bg-white w-2.5'" class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                        <button type="button" @click.prevent="activeSlide = 2" :class="activeSlide === 2 ? 'bg-amber-400 w-7' : 'bg-white/60 hover:bg-white w-2.5'" class="h-2.5 rounded-full transition-all duration-300 cursor-pointer"></button>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- 3. STATISTIK UTAMA --}}
    <section class="py-10 bg-white border-b border-slate-200 shadow-sm relative z-30 -mt-8 max-w-6xl mx-auto rounded-2xl" data-aos="fade-up" data-aos-delay="200">
        <div class="px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-x-0 sm:divide-x divide-slate-100">
                <div class="p-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-3xl lg:text-4xl font-black text-blue-600 mb-1">Unggul</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Akreditasi Sekolah</div>
                </div>
                <div class="p-2" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-3xl lg:text-4xl font-black text-blue-600 mb-1">4</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Jenjang Terpadu (TK-SMA)</div>
                </div>
                <div class="p-2" data-aos="fade-up" data-aos-delay="500">
                    <div class="text-3xl lg:text-4xl font-black text-blue-600 mb-1">25+</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Program Ekstrakurikuler</div>
                </div>
                <div class="p-2" data-aos="fade-up" data-aos-delay="600">
                    <div class="text-3xl lg:text-4xl font-black text-blue-600 mb-1">100%</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Pendidikan Budi Pekerti</div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. JENJANG PENDIDIKAN --}}
    <section id="jenjang" class="py-24 bg-slate-50">
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

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- TK -->
                <div class="bg-white rounded-2xl p-7 border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 flex flex-col justify-between text-center group"
                     data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="w-20 h-20 mb-6 mx-auto flex items-center justify-center p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/logo-tk-maitreyawira.jpg') }}" alt="Logo TK Maitreyawira" class="w-full h-full object-contain rounded-full">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-[#1b2a6b] transition">Taman Kanak-Kanak</h3>
                        <p class="text-slate-600 text-xs leading-relaxed mb-6">
                            Menanamkan kebiasaan positif, kemandirian awal, serta kecintaan belajar melalui metode eksplorasi yang menyenangkan.
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
                        <div class="w-20 h-20 mb-6 mx-auto flex items-center justify-center p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/logo-sd-maitreyawira.jpg') }}" alt="Logo SD Maitreyawira" class="w-full h-full object-contain rounded-full">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-[#1b2a6b] transition">Sekolah Dasar</h3>
                        <p class="text-slate-600 text-xs leading-relaxed mb-6">
                            Pondasi kuat literasi, numerasi, pemahaman nilai-nilai etika, bahasa asing, serta kepedulian lingkungan.
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
                        <div class="w-20 h-20 mb-6 mx-auto flex items-center justify-center p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/logo-smp-maitreyawira.jpg') }}" alt="Logo SMP Maitreyawira" class="w-full h-full object-contain rounded-full">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-[#1b2a6b] transition">Sekolah Menengah Pertama</h3>
                        <p class="text-slate-600 text-xs leading-relaxed mb-6">
                            Pengembangan bakat, logika sains, penguasaan teknologi informasi, kepemimpinan, dan kegiatan ekstrakurikuler.
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
                        <div class="w-20 h-20 mb-6 mx-auto flex items-center justify-center p-1 bg-slate-50 rounded-full border border-slate-200 shadow-sm group-hover:scale-110 transition duration-300">
                            <img src="{{ asset('images/logo-sma-maitreyawira.jpg') }}" alt="Logo SMA Maitreyawira" class="w-full h-full object-contain rounded-full">
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-[#1b2a6b] transition">Sekolah Menengah Atas</h3>
                        <p class="text-slate-600 text-xs leading-relaxed mb-6">
                            Persiapan matang menuju Perguruan Tinggi ternama, riset ilmiah, jiwa wirausaha, serta kematangan moral.
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

    {{-- 5. KEUNGGULAN SEKOLAH --}}
    <section id="keunggulan" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- TEKS DAN DAFTAR KEUNGGULAN -->
                <div class="space-y-6" data-aos="fade-right">
                    <span class="text-[#1b2a6b] font-extrabold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                        Keunggulan Utama
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 leading-tight">
                        Mengapa Memilih Sekolah Maitreyawira Palembang?
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Kami menciptakan lingkungan pendidikan komprehensif yang tidak hanya berfokus pada kecerdasan akademis, tetapi juga membentuk mentalitas kasih, kedisiplinan, serta rasa hormat terhadap sesama.
                    </p>

                    <div class="space-y-4 pt-2">
                        <div class="flex gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:border-rose-200 hover:bg-rose-50/30 transition duration-300"
                             data-aos="fade-up" data-aos-delay="150">
                            <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 shadow-sm border border-rose-200">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base">Pendidikan Budi Pekerti & Kasih Alam</h4>
                                <p class="text-slate-600 text-xs mt-1">Pembiasaan etika, moralitas luhur, dan kepedulian pada ekosistem lingkungan hidup.</p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:border-blue-200 hover:bg-blue-50/30 transition duration-300"
                             data-aos="fade-up" data-aos-delay="250">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 text-[#1b2a6b] flex items-center justify-center shrink-0 shadow-sm border border-blue-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base">Fasilitas Digital & Modern</h4>
                                <p class="text-slate-600 text-xs mt-1">Ruang kelas interaktif, laboratorium komputer modern, serta perpustakaan digital.</p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100 hover:border-amber-200 hover:bg-amber-50/30 transition duration-300"
                             data-aos="fade-up" data-aos-delay="350">
                            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 shadow-sm border border-amber-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base">Tenaga Pendidik Berpengalaman</h4>
                                <p class="text-slate-600 text-xs mt-1">Guru-guru profesional yang ramah, berdedikasi tinggi, dan kompeten di bidangnya.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- VIDEO SHOWCASE BOX -->
                <div class="relative" data-aos="fade-left" data-aos-delay="200">
                    <div class="bg-gradient-to-tr from-[#1b2a6b] to-slate-800 rounded-3xl p-3 sm:p-4 shadow-2xl relative overflow-hidden">
                        <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-lg border border-slate-700/50">
                            <iframe
                                class="w-full h-full border-0"
                                src="https://www.youtube.com/embed/Igx7Jwnn8oc"
                                title="Video Profil Sekolah Maitreyawira Palembang"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 6. BERITA & AGENDA --}}
    <section id="berita" class="py-24 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-end mb-12 gap-4" data-aos="fade-up">
                <div>
                    <span class="text-blue-600 font-extrabold text-xs uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                        Informasi Terkini
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2">
                        Berita & Kegiatan Terbaru
                    </h2>
                </div>
                <a href="/berita" class="px-5 py-2.5 bg-white hover:bg-slate-100 text-blue-600 font-bold text-xs rounded-xl border border-slate-200 shadow-sm transition">
                    Lihat Arsip Berita &rarr;
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Artikel 1 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between group"
                         data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="h-48 bg-slate-200 flex items-center justify-center text-slate-400 font-medium relative overflow-hidden">
                            <span class="group-hover:scale-105 transition duration-500">[ Foto Kegiatan Seni ]</span>
                            <span class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase">Kegiatan</span>
                        </div>
                        <div class="p-6">
                            <div class="text-xs text-slate-400 font-medium mb-2">14 Oktober 2026</div>
                            <h3 class="text-base font-bold text-slate-900 leading-snug group-hover:text-blue-600 transition line-clamp-2 mb-3">
                                Festival Budaya Kasih Alam & Pentas Seni Siswa Sekolah Maitreyawira
                            </h3>
                            <p class="text-slate-600 text-xs line-clamp-3 leading-relaxed">
                                Siswa-siswi menampilkan kreativitas seni tari, musik, dan pameran karya ramah lingkungan dengan penuh antusiasme.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2">
                        <a href="/berita" class="text-blue-600 font-bold text-xs hover:underline inline-flex items-center gap-1">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </article>

                <!-- Artikel 2 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between group"
                         data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="h-48 bg-slate-200 flex items-center justify-center text-slate-400 font-medium relative overflow-hidden">
                            <span class="group-hover:scale-105 transition duration-500">[ Foto Olimpiade ]</span>
                            <span class="absolute top-4 left-4 bg-emerald-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase">Prestasi</span>
                        </div>
                        <div class="p-6">
                            <div class="text-xs text-slate-400 font-medium mb-2">08 Oktober 2026</div>
                            <h3 class="text-base font-bold text-slate-900 leading-snug group-hover:text-blue-600 transition line-clamp-2 mb-3">
                                Perwakilan SMA Maitreyawira Meraih Juara Olimpiade Sains Tingkat Kota
                            </h3>
                            <p class="text-slate-600 text-xs line-clamp-3 leading-relaxed">
                                Prestasi membanggakan kembali diraih siswa kami dalam kompetisi sains Matematika dan Fisika.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2">
                        <a href="/berita" class="text-blue-600 font-bold text-xs hover:underline inline-flex items-center gap-1">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </article>

                <!-- Artikel 3 -->
                <article class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition duration-300 flex flex-col justify-between group"
                         data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="h-48 bg-slate-200 flex items-center justify-center text-slate-400 font-medium relative overflow-hidden">
                            <span class="group-hover:scale-105 transition duration-500">[ Foto Pengumuman ]</span>
                            <span class="absolute top-4 left-4 bg-amber-500 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase">Pengumuman</span>
                        </div>
                        <div class="p-6">
                            <div class="text-xs text-slate-400 font-medium mb-2">01 Oktober 2026</div>
                            <h3 class="text-base font-bold text-slate-900 leading-snug group-hover:text-blue-600 transition line-clamp-2 mb-3">
                                Jadwal Orientasi & Pertemuan Orang Tua Murid TA 2026/2027
                            </h3>
                            <p class="text-slate-600 text-xs line-clamp-3 leading-relaxed">
                                Pengumuman resmi mengenai agenda silaturahmi dan pemaparan program pembelajaran bagi wali murid baru.
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2">
                        <a href="/berita" class="text-blue-600 font-bold text-xs hover:underline inline-flex items-center gap-1">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- 7. FOOTER LENGKAP --}}
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
