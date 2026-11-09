{{-- File: resources/views/pendaftaran-siswa.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru (PPDB) | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS Library, FontAwesome & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    @php
        // Fallback langsung dari DB jika $configs belum dikirim via controller
        $regConfigs = $configs ?? \Illuminate\Support\Facades\DB::table('app_config')
            ->where('conf_key', 'LIKE', 'app_set_reg_%')
            ->pluck('conf_value', 'conf_key');
    @endphp

    {{-- 1. NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB (DINAMIS VIA BLADE COMPONENT <x-hero-banner>) --}}
    <x-hero-banner
        slug="pendaftaran-siswa"
        badge="PPDB T.A 2026/2027"
        title="Pendaftaran Siswa Baru"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Pendaftaran', 'url' => '#'],
            ['label' => 'Pendaftaran Siswa Baru', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN INFORMASI & ALUR --}}
    <section class="py-12 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">

                <!-- INFORMASI & ALUR PENDAFTARAN (8 Kolom) -->
                <main class="lg:col-span-8 space-y-8">

                    <!-- CARD TOMBOL UTAMA ISI FORMULIR -->
                    <div class="bg-gradient-to-r from-blue-900 via-slate-900 to-blue-950 text-white rounded-2xl p-6 sm:p-8 shadow-md flex flex-col sm:flex-row items-center justify-between gap-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="space-y-2 text-center sm:text-left">
                            <h3 class="text-xl font-black text-amber-400">Siap Mendaftar PPDB Online?</h3>
                            <p class="text-xs sm:text-sm text-slate-300">Isi formulir pendaftaran calon peserta didik baru dengan praktis dan cepat.</p>
                        </div>
                        <a href="{{ route('pendaftaran-siswa.form') }}"
                           class="inline-flex items-center gap-3 px-6 py-3.5 bg-amber-400 hover:bg-amber-300 text-slate-900 font-black text-xs sm:text-sm rounded-xl shadow-lg transition transform hover:-translate-y-0.5 shrink-0">
                            <i class="fa-solid fa-file-pen text-base"></i>
                            <span>Isi Formulir Sekarang</span>
                        </a>
                    </div>

                    <!-- CARD JUDUL REGISTRASI / SAMBUTAN -->
                    @if(!empty($regConfigs['app_set_reg_title']))
                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4" data-aos="fade-up" data-aos-delay="150">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-0.5 border border-blue-100">
                                    <i class="fa-solid fa-hand-holding-heart text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-2">Sambutan & Informasi Utama</p>
                                    <div class="text-slate-600 text-xs sm:text-sm leading-relaxed mt-1">
                                        {!! $regConfigs['app_set_reg_title'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- CARD ALUR PENDAFTARAN -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="border-b border-slate-100 pb-3">
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900">Alur Pendaftaran PPDB Online</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Langkah mudah menjadi bagian dari Sekolah Maitreyawira</p>
                        </div>

                        <div class="grid sm:grid-cols-3 gap-4">
                            <div class="p-5 rounded-xl bg-slate-50 border border-slate-100 space-y-2 hover:border-blue-200 transition" data-aos="fade-up" data-aos-delay="250">
                                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white font-black text-xs flex items-center justify-center">1</div>
                                <h3 class="font-bold text-slate-900 text-sm">1. Isi Formulir</h3>
                                <p class="text-slate-600 text-xs leading-relaxed">Lengkapi data calon siswa dan data orang tua pada formulir pendaftaran online.</p>
                            </div>

                            <div class="p-5 rounded-xl bg-slate-50 border border-slate-100 space-y-2 hover:border-blue-200 transition" data-aos="fade-up" data-aos-delay="300">
                                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white font-black text-xs flex items-center justify-center">2</div>
                                <h3 class="font-bold text-slate-900 text-sm">2. Verifikasi Data</h3>
                                <p class="text-slate-600 text-xs leading-relaxed">Tim panitia PPDB akan melakukan pengecekan dan verifikasi berkas pendaftaran.</p>
                            </div>

                            <div class="p-5 rounded-xl bg-slate-50 border border-slate-100 space-y-2 hover:border-blue-200 transition" data-aos="fade-up" data-aos-delay="350">
                                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white font-black text-xs flex items-center justify-center">3</div>
                                <h3 class="font-bold text-slate-900 text-sm">3. Konfirmasi</h3>
                                <p class="text-slate-600 text-xs leading-relaxed">Petugas akan menghubungi orang tua murid untuk proses konfirmasi dan alur selanjutnya.</p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 text-center">
                            <a href="{{ route('pendaftaran-siswa.form') }}"
                               class="inline-flex items-center gap-2 px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>Lanjut Ke Formulir Pendaftaran</span>
                            </a>
                        </div>
                    </div>

                    <!-- PERSYARATAN DOKUMEN -->
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4" data-aos="fade-up" data-aos-delay="250">
                        <div class="border-b border-slate-100 pb-3">
                            <h2 class="text-xl font-black text-slate-900">Persyaratan Dokumen</h2>
                        </div>
                        <div class="text-xs sm:text-sm text-slate-700 leading-relaxed prose max-w-none">
                            @if(!empty($regConfigs['app_set_reg_document']))
                                {!! $regConfigs['app_set_reg_document'] !!}
                            @else
                                <ul class="space-y-2.5 list-disc list-inside">
                                    <li>Fotokopi Akte Kelahiran Calon Siswa</li>
                                    <li>Fotokopi Kartu Keluarga (KK)</li>
                                    <li>Fotokopi KTP Orang Tua (Ayah & Ibu)</li>
                                    <li>Pas Foto Terbaru Calon Siswa</li>
                                    <li>Fotokopi Ijazah / SKL / Raport Terakhir (Untuk Jenjang SD, SMP, SMA)</li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    {{-- INFORMASI PEMBAYARAN / REGISTRASI --}}
                    @if(!empty($regConfigs['app_set_reg_payment']))
                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="border-b border-slate-100 pb-3">
                                <h2 class="text-xl font-black text-slate-900">Informasi Pembayaran & Registrasi</h2>
                            </div>
                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed prose max-w-none">
                                {!! $regConfigs['app_set_reg_payment'] !!}
                            </div>
                        </div>
                    @endif

                </main>

                <!-- SIDEBAR JAM OPERASIONAL (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">
                    <div class="bg-gradient-to-br from-slate-900 to-blue-950 text-white rounded-2xl p-6 shadow-md space-y-4">
                        <h4 class="font-bold text-amber-400 text-xs uppercase tracking-wider border-b border-slate-800 pb-2 flex items-center gap-2">
                            <i class="fa-regular fa-clock"></i> Jam Operasional Sekretariat
                        </h4>
                        <div class="space-y-2 text-xs text-slate-300">
                            @if(isset($serviceHours) && $serviceHours->count() > 0)
                                @foreach($serviceHours as $sh)
                                    <div class="flex justify-between border-b border-slate-800/60 pb-1.5 last:border-0 last:pb-0">
                                        <span>{{ $sh->service_day }}</span>
                                        @if(!empty($sh->hour_from) && !empty($sh->hour_to))
                                            <span class="font-bold text-white">
                                                {{ \Carbon\Carbon::parse($sh->hour_from)->format('H.i') }} - {{ \Carbon\Carbon::parse($sh->hour_to)->format('H.i') }} WIB
                                            </span>
                                        @else
                                            <span class="font-bold text-red-400">Tutup</span>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="flex justify-between border-b border-slate-800/60 pb-1.5">
                                    <span>Senin - Jumat</span>
                                    <span class="font-bold text-white">07.30 - 15.30 WIB</span>
                                </div>
                                <div class="flex justify-between border-b border-slate-800/60 pb-1.5">
                                    <span>Sabtu</span>
                                    <span class="font-bold text-white">08.00 - 12.00 WIB</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Minggu / Libur</span>
                                    <span class="font-bold text-red-400">Tutup</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @include('partials.footer')

    {{-- SCRIPT INISIALISASI AOS --}}
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
