{{-- File: resources/views/konsultasi.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Siswa | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS, FontAwesome & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB --}}
    <x-hero-banner
        slug="konsultasi"
        badge="Layanan Konsultasi Siswa"
        title="Jadwal & Bimbingan Konsultasi"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Layanan Siswa', 'url' => '#'],
            ['label' => 'Konsultasi Siswa', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN UTAMA & FORMULIR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ALERT NOTIFIKASI SUKSES --}}
            @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-5 shadow-xs flex items-start gap-4" data-aos="fade-down">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 font-bold">
                        <i class="fa-solid fa-circle-check text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-emerald-900">Pengajuan Berhasil Ditambahkan!</h4>
                        <p class="text-xs sm:text-sm mt-0.5 text-emerald-700 leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- ALERT NOTIFIKASI ERROR --}}
            @if($errors->any())
                <div class="mb-8 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl p-5 shadow-xs flex items-start gap-4" data-aos="fade-down">
                    <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 font-bold">
                        <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-rose-900">Formulir Belum Lengkap</h4>
                        <ul class="text-xs sm:text-sm mt-1 list-disc list-inside space-y-0.5 text-rose-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-12 gap-10 items-start">

                <!-- FORMULIR PENDAFTARAN KONSULTASI SISWA (8 KOLOM) -->
                <main class="lg:col-span-8 space-y-6">
                    <form action="{{ route('konsultasi.store') }}" method="POST" class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-8" data-aos="fade-up">
                        @csrf

                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900">Formulir Konsultasi Siswa Terdaftar</h2>
                            <p class="text-xs text-slate-500 mt-1">Isi data diri siswa aktif dan orang tua/wali untuk menentukan sesi waktu konsultasi dengan pihak sekolah.</p>
                        </div>

                        <!-- 1. IDENTITAS SISWA TERDAFTAR & ORANG TUA -->
                        <div class="space-y-4">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-user-graduate text-amber-500"></i>
                                <span>Data Siswa & Orang Tua / Wali</span>
                            </h3>

                            <div class="grid sm:grid-cols-2 gap-4">
                                <!-- Nama Lengkap Siswa -->
                                <div class="space-y-1.5">
                                    <label for="nama_siswa_scd" class="block text-xs font-bold text-slate-700">
                                        Nama Lengkap Siswa <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text"
                                           id="nama_siswa_scd"
                                           name="nama_siswa_scd"
                                           value="{{ old('nama_siswa_scd') }}"
                                           placeholder="Masukkan nama lengkap siswa"
                                           required
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition">
                                </div>

                                <!-- Nama Orang Tua / Wali -->
                                <div class="space-y-1.5">
                                    <label for="nama_ortu_scd" class="block text-xs font-bold text-slate-700">
                                        Nama Orang Tua / Wali <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text"
                                           id="nama_ortu_scd"
                                           name="nama_ortu_scd"
                                           value="{{ old('nama_ortu_scd') }}"
                                           placeholder="Masukkan nama orang tua / wali"
                                           required
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition">
                                </div>

                                <!-- Kelas / Unit Sekolah Siswa -->
                                <div class="space-y-1.5 sm:col-span-2">
                                    <label for="asal_sekolah_scd" class="block text-xs font-bold text-slate-700">
                                        Kelas & Unit Sekolah Siswa Saat Ini <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text"
                                           id="asal_sekolah_scd"
                                           name="asal_sekolah_scd"
                                           value="{{ old('asal_sekolah_scd') }}"
                                           placeholder="Contoh: SMA Maitreyawira Palembang - Kelas XI IPA 1"
                                           required
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition">
                                </div>

                                <!-- Nomor WhatsApp Orang Tua / Wali -->
                                <div class="space-y-1.5">
                                    <label for="no_wa_ortu_scd" class="block text-xs font-bold text-slate-700">
                                        No. WhatsApp (Aktif) <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="tel"
                                           id="no_wa_ortu_scd"
                                           name="no_wa_ortu_scd"
                                           value="{{ old('no_wa_ortu_scd') }}"
                                           placeholder="Contoh: 081234567890"
                                           required
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition">
                                </div>

                                <!-- Email Orang Tua / Siswa -->
                                <div class="space-y-1.5">
                                    <label for="email_scd" class="block text-xs font-bold text-slate-700">
                                        Alamat Email <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="email"
                                           id="email_scd"
                                           name="email_scd"
                                           value="{{ old('email_scd') }}"
                                           placeholder="Contoh: email@domain.com"
                                           required
                                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition">
                                </div>
                            </div>
                        </div>

                        <!-- 2. PILIHAN JADWAL KONSULTASI (CONSULTATION_SET) -->
                        <div class="space-y-4 pt-4 border-t border-slate-100">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fa-solid fa-calendar-check text-amber-500"></i>
                                    <span>Pilih Sesi Konsultasi Tersedia</span> <span class="text-rose-500">*</span>
                                </h3>
                            </div>

                            @if(isset($schedules) && $schedules->count() > 0)
                                <div class="grid sm:grid-cols-2 gap-3 max-h-[360px] overflow-y-auto pr-1">
                                    @foreach($schedules as $scd)
                                        <label class="relative flex items-start p-4 rounded-xl border border-slate-200 hover:border-amber-400 cursor-pointer transition bg-slate-50/50 hover:bg-amber-50/30 group">
                                            <input type="radio"
                                                   name="cons_id"
                                                   value="{{ $scd->cons_id }}"
                                                   {{ old('cons_id') == $scd->cons_id ? 'checked' : '' }}
                                                   class="mt-1 text-amber-500 focus:ring-amber-400 accent-amber-500">

                                            <div class="ml-3 space-y-1">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    @if(!empty($scd->jenjang))
                                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-black bg-slate-900 text-amber-400 uppercase">
                                                            {{ $scd->jenjang }}
                                                        </span>
                                                    @endif
                                                    @if(!empty($scd->cons_jen_jad))
                                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-200">
                                                            {{ $scd->cons_jen_jad }}
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="text-xs sm:text-sm font-extrabold text-slate-900 group-hover:text-amber-600 transition">
                                                    {{ $scd->cons_hari ? $scd->cons_hari . ',' : '' }}
                                                    {{ \Carbon\Carbon::parse($scd->cons_tanggal)->translatedFormat('d F Y') }}
                                                </div>

                                                <div class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                                                    <i class="fa-regular fa-clock text-amber-500"></i>
                                                    <span>{{ $scd->cons_jam ?? 'Sesuai Kesepakatan' }} WIB</span>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-6 text-center border border-dashed border-slate-200 rounded-xl text-slate-400 text-xs italic space-y-2">
                                    <i class="fa-solid fa-calendar-xmark text-2xl text-slate-300"></i>
                                    <p>Belum ada sesi jadwal konsultasi yang dibuka saat ini. Silakan hubungi layanan kontak sekolah.</p>
                                </div>
                            @endif
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <button type="submit"
                                    class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-slate-900 font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Kirim Pengajuan Konsultasi</span>
                            </button>
                        </div>
                    </form>
                </main>

                <!-- SIDEBAR INFORMASI LAYANAN SEKOLAH (4 KOLOM) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- Kartu Panduan Konsultasi -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-blue-600"></i> Alur Konsultasi Siswa
                        </h3>

                        <ol class="space-y-3 text-xs text-slate-600 list-decimal list-inside leading-relaxed font-medium">
                            <li class="pl-1"><strong class="text-slate-900">Pengisian Data:</strong> Isi nama siswa, kelas, dan kontak orang tua/wali.</li>
                            <li class="pl-1"><strong class="text-slate-900">Pilih Jadwal:</strong> Tentukan hari dan sesi jam konsultasi yang masih tersedia.</li>
                            <li class="pl-1"><strong class="text-slate-900">Konfirmasi WA:</strong> Pihak sekolah/wali kelas akan mengonfirmasi sesi melalui WhatsApp.</li>
                        </ol>
                    </div>

                    <!-- Kartu Kontak Sekolah -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3 flex items-center gap-2">
                            <i class="fa-solid fa-headset text-emerald-600"></i> Kontak Layanan Sekolah
                        </h3>

                        <p class="text-xs text-slate-600 leading-relaxed">
                            Butuh bantuan lebih lanjut atau perubahan jadwal konsultasi siswa?
                        </p>

                        <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center justify-center gap-2 w-full py-2.5 px-4 bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-xs rounded-xl shadow-xs transition">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Hubungi Layanan Sekolah</span>
                        </a>
                    </div>

                </aside>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @include('partials.footer')

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
