{{-- File: resources/views/form.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst(str_replace('-', ' ', $formType ?? 'Formulir')) }} | Sekolah Maitreyawira Palembang</title>

    {{-- Vite / Tailwind CDN --}}
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen">

    {{-- 1. NAVBAR PARTIAL --}}
    @if(View::exists('partials.navbar'))
        @include('partials.navbar')
    @else
        <header class="bg-white border-b border-slate-200 py-4 px-6">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="/" class="font-black text-blue-900">SEKOLAH MAITREYAWIRA</a>
                <a href="/" class="text-xs font-bold text-slate-600 hover:text-blue-600">Beranda</a>
            </div>
        </header>
    @endif

    {{-- 2. KONTEN FORMULIR UTAMA --}}
    <main class="py-12 flex-grow flex items-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 w-full">

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 sm:p-10">

                <!-- Header Formulir -->
                <div class="border-b border-slate-100 pb-6 mb-6">
                    <div class="flex items-center gap-2 text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Portal Layanan Informasi</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 capitalize">
                        {{ str_replace('-', ' ', $formType ?? 'Formulir Publik') }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Silakan lengkapi seluruh isian formulir di bawah ini dengan data yang benar.
                    </p>
                </div>

                <!-- Container Alert Notifikasi -->
                <div id="alert-container">
                    @if(session('success'))
                        <div class="p-4 mb-6 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="p-4 mb-6 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center gap-3">
                            <i class="fa-solid fa-circle-exclamation text-rose-600 text-base shrink-0"></i>
                            <div><strong>Gagal!</strong> {{ session('error') }}</div>
                        </div>
                    @endif
                </div>

                <!-- Form Submisi -->
                <form id="publicForm"
                      action="{{ route('form.submit', $formType ?? 'hubungi-kami') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-5 text-xs sm:text-sm">

                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nama Lengkap -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Masukkan nama lengkap"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs transition"
                                   required>
                        </div>

                        <!-- Alamat Email -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">
                                Alamat Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="nama@email.com"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs transition"
                                   required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nomor Telepon / WA -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">
                                No. HP / WhatsApp <span class="text-rose-500">*</span>
                            </label>
                            <input type="tel"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="Contoh: 081234567890"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs transition"
                                   required>
                        </div>

                        <!-- Subjek / Judul -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">
                                Subjek / Perihal <span class="text-rose-500">*</span>
                            </label>
                            <input type="text"
                                   name="subject"
                                   value="{{ old('subject') }}"
                                   placeholder="Tuliskan judul perihal"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs transition"
                                   required>
                        </div>
                    </div>

                    <!-- Pesan / Catatan Detail -->
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 block">
                            Isi Pesan / Keterangan <span class="text-rose-500">*</span>
                        </label>
                        <textarea name="message"
                                  rows="5"
                                  placeholder="Tuliskan rincian informasi atau pertanyaan Anda..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs transition"
                                  required>{{ old('message') }}</textarea>
                    </div>

                    <!-- Unggah Berkas Lampiran -->
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 block">
                            Lampiran Dokumen / Berkas <span class="text-slate-400 font-normal">(Opsional)</span>
                        </label>
                        <input type="file"
                               name="file"
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-slate-200 rounded-xl p-1 transition">
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 flex items-center justify-end gap-3">
                        <button type="reset" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition">
                            Reset
                        </button>
                        <button id="btnSubmit"
                                type="submit"
                                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md transition flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Kirim Formulir</span>
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </main>

    {{-- 3. FOOTER PARTIAL --}}
    @if(View::exists('partials.footer'))
        @include('partials.footer')
    @else
        <footer class="bg-slate-900 text-slate-400 py-6 text-center text-xs border-t border-slate-800">
            <p>&copy; {{ date('Y') }} Sekolah Maitreyawira Palembang. All rights reserved.</p>
        </footer>
    @endif

    {{-- Script AJAX Submit Handler --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('publicForm');
            const alertContainer = document.getElementById('alert-container');
            const btnSubmit = document.getElementById('btnSubmit');

            if (!form) return;

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                btnSubmit.disabled = true;
                btnSubmit.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> <span>Memproses...</span>`;

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
                            <div class="p-4 mb-6 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-3">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                                <div><strong>Berhasil!</strong> ${data.message}</div>
                            </div>
                        `;
                    } else {
                        alertContainer.innerHTML = `
                            <div class="p-4 mb-6 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center gap-3">
                                <i class="fa-solid fa-circle-exclamation text-rose-600 text-base shrink-0"></i>
                                <div><strong>Gagal!</strong> ${data.message}</div>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    alertContainer.innerHTML = `
                        <div class="p-4 mb-6 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center gap-3">
                            <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base shrink-0"></i>
                            <div><strong>Kesalahan Sistem!</strong> Terjadi kendala saat mengirim data. Coba beberapa saat lagi.</div>
                        </div>
                    `;
                })
                .finally(() => {
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = `<i class="fa-solid fa-paper-plane"></i> <span>Kirim Formulir</span>`;
                });
            });
        });
    </script>
</body>
</html>
