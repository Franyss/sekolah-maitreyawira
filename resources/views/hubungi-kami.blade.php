{{-- File: resources/views/hubungi-kami.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hubungi Kami' }} | Sekolah Maitreyawira Palembang</title>

    {{-- Vite CSS untuk Production/Development --}}
    @vite('resources/css/app.css')

    {{-- Fallback Tailwind CDN & FontAwesome untuk Pratinjau Langsung --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body
    class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @if (View::exists('partials.navbar'))
        @include('partials.navbar')
    @else
        <!-- Fallback Navbar Sederhana jika Partial Belum Ada -->
        <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                <a href="/" class="text-lg sm:text-xl font-black text-blue-900 tracking-tight">
                    SEKOLAH MAITREYAWIRA <span class="text-amber-500">PALEMBANG</span>
                </a>
                <nav class="hidden sm:flex gap-6 text-xs font-bold text-slate-600">
                    <a href="/" class="hover:text-blue-600 transition">Beranda</a>
                    <a href="{{ route('hubungi-kami.index') }}" class="text-blue-600 font-extrabold">Hubungi Kami</a>
                </nav>
            </div>
        </header>
    @endif

    {{-- 2. HERO BANNER & BREADCRUMB --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-16 sm:py-20">
        <!-- Background Overlay Pattern -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div
            class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <!-- Breadcrumb -->
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <span class="text-amber-400">Hubungi Kami</span>
            </nav>

            <div class="max-w-3xl space-y-4">
                <span
                    class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                    Pusat Bantuan & Sekretariat
                </span>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    Layanan Informasi & Kontak <br>
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500">
                        Sekolah Maitreyawira Palembang
                    </span>
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Kami siap melayani pertanyaan, konsultasi pendaftaran murid baru, kunjungan kampus, maupun informasi
                    umum seputar sekolah.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-start">

                <!-- KONTEN UTAMA (8 Kolom) -->
                <main class="lg:col-span-8 space-y-10">

                    <!-- FORMULIR PESAN & PERTANYAAN -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-6">
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-black text-slate-900">Kirim Pesan / Pertanyaan</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Sampaikan pesan
                                Anda langsung ke tim layanan kami</p>
                        </div>

                        <!-- Container Notifikasi AJAX -->
                        <div id="alert-container"></div>

                        <form id="contactForm" action="{{ route('hubungi-kami.send') }}" method="POST"
                            class="space-y-4 text-xs sm:text-sm">
                            @csrf
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="font-bold text-slate-700 block">Nama Lengkap <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="form_name" placeholder="Masukkan nama Anda"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs"
                                        required>
                                </div>
                                <div class="space-y-1">
                                    <label class="font-bold text-slate-700 block">Alamat Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="form_email" placeholder="nama@email.com"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs"
                                        required>
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="font-bold text-slate-700 block">No. HP / WhatsApp <span
                                            class="text-red-500">*</span></label>
                                    <input type="tel" name="form_phone" placeholder="Contoh: 081234567890"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs"
                                        required>
                                </div>
                                <div class="space-y-1">
                                    <label class="font-bold text-slate-700 block">Kategori Pertanyaan</label>
                                    <select name="form_category"
                                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs bg-white">
                                        <option value="PPDB / Pendaftaran">PPDB / Pendaftaran Murid Baru</option>
                                        <option value="Informasi Akademik">Informasi Akademik & Kurikulum</option>
                                        <option value="Kunjungan Sekolah">Kunjungan Sekolah / Campus Tour</option>
                                        <option value="Lainnya">Pertanyaan Lainnya</option>
                                    </select>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Subjek Pesan <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="form_subject"
                                    placeholder="Tuliskan judul/subjek pesan singkat"
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs"
                                    required>
                            </div>

                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Isi Pesan <span
                                        class="text-red-500">*</span></label>
                                <textarea name="form_message" rows="4" placeholder="Tuliskan pesan atau pertanyaan Anda secara rinci..."
                                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs"
                                    required></textarea>
                            </div>

                            <button type="submit" id="btnSubmit"
                                class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-xs rounded-xl shadow-md transition flex justify-center items-center gap-2">
                                <span>Kirim Pesan Sekarang</span>
                            </button>
                        </form>
                    </div>

                    <!-- LOKASI PETA GOOGLE MAPS -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4">
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-black text-slate-900">Peta Lokasi Kampus</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Kunjungi Kampus
                                Sekolah Maitreyawira Palembang</p>
                        </div>

                        <div
                            class="w-full h-80 rounded-xl overflow-hidden border border-slate-200 shadow-inner bg-slate-100">
                            {{-- Embed Google Maps Dinamis / Fallback --}}
                            <iframe class="w-full h-full border-0"
                                src="https://maps.google.com/maps?q={{ urlencode($web['app_gmap_keyword'] ?? 'Sekolah Maitreyawira Palembang') }}&t=&z=15&ie=UTF8&iwloc=&output=embed"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                </main>

                <!-- SIDEBAR INFORMASI KONTAK & JAM OPERASIONAL (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28">

                    <!-- Kartu Informasi Alamat & Kontak -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-6">
                        <h3
                            class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Informasi Kontak
                        </h3>

                        <div class="space-y-4 text-xs sm:text-sm text-slate-700">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-base shrink-0 mt-0.5">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">Alamat Sekolah</h4>
                                    <p class="text-slate-600 text-xs mt-0.5 leading-relaxed">
                                        {{ $web['app_address'] ?? 'Jl. Residen Abdul Rozak, Kalidoni, Kota Palembang, Sumatera Selatan' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-base shrink-0 mt-0.5">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">WhatsApp & Telepon</h4>
                                    <p class="text-slate-600 text-xs mt-0.5 leading-relaxed">
                                        {{ $web['app_phone'] ?? '(0711) XXXXXX' }} <br>
                                        @if (!empty($web['app_sm_wa'] ?? null))
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $web['app_sm_wa']) }}"
                                                target="_blank" class="text-emerald-600 font-bold hover:underline">
                                                {{ $web['app_sm_wa'] }} (PPDB Online)
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-base shrink-0 mt-0.5">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">Email Resmi</h4>
                                    <p class="text-slate-600 text-xs mt-0.5 leading-relaxed">
                                        <a href="mailto:{{ $web['app_email_info'] ?? 'info@maitreyawira-palembang.sch.id' }}"
                                            class="hover:text-blue-600 transition">
                                            {{ $web['app_email_info'] ?? 'info@maitreyawira-palembang.sch.id' }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jam Operasional Sekretariat -->
                    <!-- Jam Operasional Sekretariat -->
                    <div
                        class="bg-gradient-to-br from-slate-900 to-blue-950 text-white rounded-2xl p-6 shadow-md space-y-4">
                        <h4
                            class="font-bold text-amber-400 text-sm uppercase tracking-wider border-b border-slate-800 pb-2 flex items-center gap-2">
                            <i class="fa-regular fa-clock"></i> Jam Operasional Kantor
                        </h4>
                        <div class="space-y-2 text-xs text-slate-300">
                            @if (isset($serviceHours) && $serviceHours->count() > 0)
                                @foreach ($serviceHours as $sh)
                                    <div
                                        class="flex justify-between border-b border-slate-800/60 pb-1.5 last:border-0 last:pb-0">
                                        <span>{{ $sh->service_day }}</span>

                                        @if (!empty($sh->hour_from) && !empty($sh->hour_to))
                                            <span class="font-bold text-white">
                                                {{ \Carbon\Carbon::parse($sh->hour_from)->format('H.i') }} -
                                                {{ \Carbon\Carbon::parse($sh->hour_to)->format('H.i') }} WIB
                                            </span>
                                        @else
                                            <span class="font-bold text-red-400">Tutup</span>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                {{-- Fallback Tampilan Statis jika Database Kosong --}}
                                <div class="flex justify-between border-b border-slate-800/60 pb-1.5">
                                    <span>Senin - Jumat</span>
                                    <span class="font-bold text-white">07.30 - 15.30 WIB</span>
                                </div>
                                <div class="flex justify-between border-b border-slate-800/60 pb-1.5">
                                    <span>Sabtu</span>
                                    <span class="font-bold text-white">08.00 - 12.00 WIB</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Minggu / Hari Libur</span>
                                    <span class="font-bold text-red-400">Tutup</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Widget PPDB Call-to-Action -->
                    <div
                        class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl p-6 text-slate-900 shadow-md space-y-4">
                        <div class="font-black text-lg leading-tight">
                            Ingin Mendaftar PPDB Online?
                        </div>
                        <p class="text-xs text-slate-800 font-medium leading-relaxed">
                            Proses pendaftaran murid baru dapat dilakukan secara penuh melalui portal online kami.
                        </p>
                        <a href="{{ route('pendaftaran-siswa.index') }}"
                            class="inline-block w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-amber-400 font-extrabold text-xs text-center rounded-xl shadow-xs transition">
                            Ke Halaman Pendaftaran →
                        </a>
                    </div>

                </aside>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @if (View::exists('partials.footer'))
        @include('partials.footer')
    @else
        <footer class="bg-slate-900 text-slate-400 py-6 text-center text-xs border-t border-slate-800">
            <p>&copy; {{ date('Y') }} Sekolah Maitreyawira Palembang. All rights reserved.</p>
        </footer>
    @endif

    {{-- Script JavaScript Fetch API --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const alertContainer = document.getElementById('alert-container');
            const btnSubmit = document.getElementById('btnSubmit');

            if (!form) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                btnSubmit.disabled = true;
                btnSubmit.innerHTML =
                    `<i class="fa-solid fa-spinner fa-spin"></i> <span>Mengirim pesan...</span>`;

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === true) {
                            form.reset();
                            alertContainer.innerHTML = `
                            <div class="p-4 mb-4 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                                <div><strong>Berhasil!</strong> ${data.message || 'Pesan Anda telah kami terima.'}</div>
                            </div>
                        `;
                        } else {
                            alertContainer.innerHTML = `
                            <div class="p-4 mb-4 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation text-rose-600 text-base"></i>
                                <div><strong>Gagal!</strong> ${data.message || 'Silakan periksa kembali inputan Anda.'}</div>
                            </div>
                        `;
                        }
                    })
                    .catch(error => {
                        alertContainer.innerHTML = `
                        <div class="p-4 mb-4 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center gap-2">
                            <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base"></i>
                            <div><strong>Kesalahan Sistem!</strong> Terjadi kendala saat mengirim pesan. Coba lagi nanti.</div>
                        </div>
                    `;
                    })
                    .finally(() => {
                        btnSubmit.disabled = false;
                        btnSubmit.innerHTML = `<span>Kirim Pesan Sekarang</span>`;

                        // Otomatis hilangkan alert setelah 6 detik
                        setTimeout(() => {
                            alertContainer.innerHTML = '';
                        }, 6000);
                    });
            });
        });
    </script>
</body>

</html>
