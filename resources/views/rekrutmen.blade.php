{{-- File: resources/views/rekrutmen.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karir & Rekrutmen | Sekolah Maitreyawira Palembang</title>

    {{-- Asset Vite & Fallback Tailwind CDN --}}
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen">

    {{-- 1. NAVBAR PARTIAL --}}
    @if(View::exists('partials.navbar'))
        @include('partials.navbar')
    @else
        <header class="bg-white border-b border-slate-200 py-4 px-6 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="/" class="font-black text-blue-900 tracking-tight text-lg">
                    SEKOLAH MAITREYAWIRA <span class="text-amber-500">PALEMBANG</span>
                </a>
            </div>
        </header>
    @endif

    {{-- 2. HERO BANNER --}}
    <section class="relative bg-slate-900 text-white overflow-hidden py-14 sm:py-16">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <nav class="flex text-xs font-semibold text-slate-400 mb-3 gap-2 items-center">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <span class="text-amber-400">Karir & Rekrutmen</span>
            </nav>

            <div class="max-w-3xl space-y-3">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-blue-500/20 text-blue-300 border border-blue-500/30 uppercase tracking-widest">
                    Peluang Karir & Pengabdian
                </span>
                <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
                    Bergabung Bersama Kami di <br>
                    <span class="text-amber-400">Sekolah Maitreyawira Palembang</span>
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Mari berkontribusi membangun generasi berkarakter luhur, berbudaya kasih alam, dan unggul dalam keilmuan.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. DAFTAR LOWONGAN & FORMULIR LAMARAN --}}
    <section class="py-12 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">

                <!-- DAFTAR LOWONGAN PEKERJAAN (7 Kolom) -->
                <main class="lg:col-span-7 space-y-6">
                    <div class="flex justify-between items-center border-b border-slate-200 pb-3">
                        <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-briefcase text-blue-600"></i>
                            <span>Lowongan Tersedia</span>
                        </h2>
                        <span class="text-xs bg-blue-50 text-blue-700 font-bold px-3 py-1 rounded-full border border-blue-100">
                            {{ count($jobs) }} Posisi Dibuka
                        </span>
                    </div>

                    @forelse($jobs as $job)
                        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition space-y-4">
                            <div class="flex justify-between items-start gap-4">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $job->title }}</h3>
                                    <p class="text-xs text-slate-400 mt-1 flex items-center gap-3">
                                        <span><i class="fa-regular fa-calendar-check text-emerald-500 mr-1"></i> Buka: {{ \Carbon\Carbon::parse($job->datetime_open)->format('d M Y') }}</span>
                                        @if($job->datetime_close)
                                            <span><i class="fa-regular fa-calendar-xmark text-rose-500 mr-1"></i> Tutup: {{ \Carbon\Carbon::parse($job->datetime_close)->format('d M Y') }}</span>
                                        @endif
                                    </p>
                                </div>
                                <button onclick="selectJob({{ $job->job_id }}, '{{ addslashes($job->title) }}')"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-xs transition shrink-0 flex items-center gap-2">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span>Lamar</span>
                                </button>
                            </div>

                            @if($job->description)
                                <div class="text-xs text-slate-600 space-y-1 border-t border-slate-100 pt-3">
                                    <strong class="text-slate-800 block font-bold">Deskripsi Pekerjaan:</strong>
                                    <div class="prose prose-slate max-w-none text-xs">{!! $job->description !!}</div>
                                </div>
                            @endif

                            @if($job->spesification)
                                <div class="text-xs text-slate-600 space-y-1 bg-slate-50 p-3 rounded-xl border border-slate-100">
                                    <strong class="text-slate-800 block font-bold">Kualifikasi / Spesifikasi:</strong>
                                    <div class="prose prose-slate max-w-none text-xs">{!! $job->spesification !!}</div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl p-10 border border-slate-200/80 text-center text-slate-400 space-y-3">
                            <i class="fa-solid fa-folder-open text-4xl text-slate-300"></i>
                            <p class="text-xs font-medium">Saat ini belum ada lowongan pekerjaan yang dibuka.</p>
                        </div>
                    @endforelse
                </main>

                <!-- FORMULIR LAMARAN PEKERJAAN (5 Kolom) -->
                <aside class="lg:col-span-5 sticky top-28">
                    <div class="bg-white rounded-2xl p-6 sm:p-7 border border-slate-200/80 shadow-sm space-y-5">

                        <div class="border-b border-slate-100 pb-3">
                            <h3 class="text-base font-black text-slate-900">Formulir Lamaran Pekerjaan</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Isi data diri dan lampirkan CV terbaru Anda.</p>
                        </div>

                        <!-- Alert Container -->
                        <div id="alert-container">
                            @if(session('success'))
                                <div class="p-4 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                                    <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                                </div>
                            @endif
                        </div>

                        <form id="applyForm"
                              action="{{ route('rekrutmen.apply') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="space-y-4 text-xs sm:text-sm">
                            @csrf

                            <!-- Pilihan Posisi Job -->
                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Posisi Yang Dilamar <span class="text-red-500">*</span></label>
                                <select id="job_id" name="job_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white" required>
                                    <option value="">-- Pilih Posisi Lowongan --</option>
                                    @foreach($jobs as $j)
                                        <option value="{{ $j->job_id }}" {{ old('job_id') == $j->job_id ? 'selected' : '' }}>
                                            {{ $j->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Nama Lengkap Pelamar <span class="text-red-500">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Masukkan nama lengkap Anda" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select name="jk" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <!-- Email -->
                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Alamat Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                            </div>

                            <!-- Sumber Informasi (job_source) -->
                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Sumber Informasi Lowongan <span class="text-red-500">*</span></label>
                                <select name="job_source_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white" required>
                                    <option value="">-- Pilih Sumber Informasi --</option>
                                    @foreach($sources as $src)
                                        <option value="{{ $src->job_source_id }}" {{ old('job_source_id') == $src->job_source_id ? 'selected' : '' }}>
                                            {{ $src->job_source_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Upload CV File -->
                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Unggah Berkas CV / Resume <span class="text-red-500">*</span> <small class="text-slate-400 font-normal">(PDF/DOC, Max 5MB)</small></label>
                                <input type="file" name="cv_file" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 border border-slate-200 rounded-xl p-1" required>
                            </div>

                            <!-- Catatan / Note -->
                            <div class="space-y-1">
                                <label class="font-bold text-slate-700 block">Catatan Tambahan / Ringkasan Diri</label>
                                <textarea name="note" rows="3" placeholder="Tuliskan pengalaman singkat atau pesan untuk HRD..." class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs">{{ old('note') }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit" id="btnSubmit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition flex justify-center items-center gap-2">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span>Kirim Lamaran Pekerjaan</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </aside>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @if(View::exists('partials.footer'))
        @include('partials.footer')
    @else
        <footer class="bg-slate-900 text-slate-400 py-6 text-center text-xs border-t border-slate-800">
            <p>&copy; {{ date('Y') }} Sekolah Maitreyawira Palembang. All rights reserved.</p>
        </footer>
    @endif

    {{-- Script JavaScript Interaktif & AJAX Submit --}}
    <script>
        function selectJob(jobId, jobTitle) {
            const selectEl = document.getElementById('job_id');
            if (selectEl) {
                selectEl.value = jobId;
                selectEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                selectEl.classList.add('ring-2', 'ring-blue-500');
                setTimeout(() => selectEl.classList.remove('ring-2', 'ring-blue-500'), 2000);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('applyForm');
            const alertContainer = document.getElementById('alert-container');
            const btnSubmit = document.getElementById('btnSubmit');

            if (!form) return;

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                btnSubmit.disabled = true;
                btnSubmit.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> <span>Mengirim Lamaran...</span>`;

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
                            <div class="p-4 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                                <div><strong>Berhasil!</strong> ${data.message}</div>
                            </div>
                        `;
                    } else {
                        alertContainer.innerHTML = `
                            <div class="p-4 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation text-rose-600 text-base shrink-0"></i>
                                <div><strong>Gagal!</strong> ${data.message || 'Periksa kembali kelengkapan isian Anda.'}</div>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    alertContainer.innerHTML = `
                        <div class="p-4 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center gap-2">
                            <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base shrink-0"></i>
                            <div><strong>Kesalahan Sistem!</strong> Gagal mengirim lamaran. Pastikan format & ukuran file CV sudah benar.</div>
                        </div>
                    `;
                })
                .finally(() => {
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = `<i class="fa-solid fa-paper-plane"></i> <span>Kirim Lamaran Pekerjaan</span>`;
                });
            });
        });
    </script>
</body>

</html>
