{{-- File: resources/views/testimoni.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni Orang Tua Siswa | Maitreyawira Palembang</title>

    {{-- CSS AOS & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB (DINAMIS VIA BLADE COMPONENT <x-hero-banner>) --}}
    <x-hero-banner
        slug="testimoni"
        badge="Kepercayaan Orang Tua"
        title="Testimoni Orang Tua Siswa"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Tentang Kami', 'url' => '#'],
            ['label' => 'Testimoni', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN UTAMA --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- INTRO SINGKAT -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4" data-aos="fade-up" data-aos-delay="100">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-2xl font-black text-slate-900">Suara Orang Tua Murid</h2>
                    <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Sinergi Sekolah dan Rumah</p>
                </div>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Kami mempercayai bahwa pembentukan karakter anak yang kuat lahir dari kolaborasi yang erat antara sekolah dan orang tua. Berikut adalah pesan dan testimoni yang disampaikan oleh orang tua dari berbagai tingkatan jenjang pendidikan.
                </p>
            </div>

            <!-- GRID TESTIMONI DARI DATABASE -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(!empty($testimonies) && count($testimonies) > 0)
                    @foreach($testimonies as $index => $item)
                        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between space-y-6"
                             data-aos="fade-up" data-aos-delay="{{ 150 + ($index * 100) }}">
                            <div class="space-y-4">
                                <!-- BADGE TINGKATAN -->
                                <div class="flex items-center justify-between">
                                    <span class="px-3 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-800 border border-amber-200 uppercase tracking-wider">
                                        {{ $item->testimony_title }}
                                    </span>
                                    <svg class="w-8 h-8 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                    </svg>
                                </div>

                                <!-- ISI TESTIMONI -->
                                <div class="text-slate-700 text-sm sm:text-base leading-relaxed space-y-2">
                                    {!! nl2br(e($item->testimony_content)) !!}
                                </div>
                            </div>

                            <!-- FOOTER KARTU -->
                            <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-900 text-amber-400 font-extrabold flex items-center justify-center text-sm border border-blue-800 shadow-xs">
                                    {{ strtoupper(substr($item->testimony_title, 10, 2) ?: 'MW') }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900">Orang Tua Siswa</h4>
                                    <p class="text-xs text-slate-500 font-medium">{{ $item->testimony_title }} Maitreyawira</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="md:col-span-2 bg-white rounded-2xl p-8 text-center text-slate-400 italic border border-dashed border-slate-300" data-aos="fade-up">
                        Belum ada data testimoni yang ditambahkan ke database.
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
