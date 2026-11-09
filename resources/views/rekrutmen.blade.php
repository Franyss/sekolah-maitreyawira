{{-- File: resources/views/rekrutmen.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karir & Rekrutmen | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS Library, FontAwesome & Vite Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen overflow-x-hidden">

    {{-- 1. HEADER / NAVBAR PARTIAL --}}
    @include('partials.navbar')

    {{-- 2. HERO BANNER & BREADCRUMB (DINAMIS VIA BLADE COMPONENT <x-hero-banner>) --}}
    <x-hero-banner
        slug="rekrutmen"
        badge="Karir & Kesempatan Bergabung"
        title="Peluang Karir & Rekrutmen"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Karir', 'url' => '#'],
            ['label' => 'Rekrutmen', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN UTAMA --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Alert Notifikasi Sukses / Gagal -->
            @if(session('success'))
                <div class="p-4 text-xs sm:text-sm text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-3 shadow-xs" data-aos="zoom-in">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg shrink-0"></i>
                    <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 text-xs sm:text-sm text-rose-800 rounded-2xl bg-rose-50 border border-rose-200 space-y-1 shadow-xs" data-aos="zoom-in">
                    <div class="font-bold flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation text-rose-600 text-lg"></i>
                        <span>Terjadi kesalahan pengisian form:</span>
                    </div>
                    <ul class="list-disc list-inside pl-5 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- DAFTAR LOWONGAN PEKERJAAN AKTIF -->
            <div class="space-y-6">
                <div class="border-b border-slate-200 pb-4 flex flex-wrap items-center justify-between gap-4" data-aos="fade-up">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">Lowongan Pekerjaan Tersedia</h2>
                        <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-0.5">Posisi Pendidik & Tenaga Kependidikan</p>
                    </div>
                    <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold border border-blue-100">
                        {{ $jobs->count() }} Posisi Aktif
                    </span>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($jobs as $index => $job)
                        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between group"
                             data-aos="fade-up" data-aos-delay="{{ 100 + ($index % 3) * 100 }}">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-extrabold bg-blue-50 text-blue-600 border border-blue-100 uppercase tracking-wider">
                                        {{ $job->job_category ?? 'Full Time' }}
                                    </span>
                                    <span class="text-[11px] text-slate-400 font-medium flex items-center gap-1">
                                        <i class="fa-regular fa-calendar-xmark text-slate-400"></i>
                                        {{ !empty($job->datetime_close) ? \Carbon\Carbon::parse($job->datetime_close)->translatedFormat('d M Y') : 'Buka' }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-black text-slate-900 group-hover:text-blue-600 transition leading-snug">
                                    {{ $job->job_title }}
                                </h3>

                                <div class="text-slate-600 text-xs leading-relaxed line-clamp-4">
                                    {!! strip_tags($job->job_desc ?? $job->job_requirement) !!}
                                </div>
                            </div>

                            <div class="pt-6 mt-4 border-t border-slate-100">
                                <button type="button"
                                        onclick="selectJob('{{ $job->job_id }}', '{{ addslashes($job->job_title) }}')"
                                        class="w-full py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer shadow-xs">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span>Lamar Posisi Ini</span>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="sm:col-span-2 lg:col-span-3 bg-white rounded-2xl p-10 text-center text-slate-400 border border-dashed border-slate-300 space-y-3" data-aos="fade-up">
                            <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-xl">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <div class="font-bold text-slate-700 text-sm">Saat ini belum ada lowongan pekerjaan yang dibuka.</div>
                            <p class="text-xs text-slate-500 max-w-md mx-auto leading-relaxed">
                                Silakan cek berkala halaman rekrutmen ini untuk mendapatkan pembaruan posisi pekerjaan terbaru di Sekolah Maitreyawira Palembang.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- FORMULIR LAMARAN PEKERJAAN -->
            <div id="form-lamaran" class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up" data-aos-delay="200">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-file-signature text-blue-600"></i>
                        <span>Formulir Pengajuan Lamaran Pekerjaan</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">Isi formulir berikut secara lengkap dan unggah dokumen Kurikulum Vitae (CV) Anda.</p>
                </div>

                <form action="{{ route('rekrutmen.apply') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-5 text-xs sm:text-sm">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- 1. Pilih Posisi Pekerjaan -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Posisi Lowongan Pekerjaan <span class="text-red-500">*</span></label>
                            <select name="job_id" id="job_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white" required>
                                <option value="">-- Pilih Posisi Lowongan --</option>
                                @foreach($jobs as $job)
                                    <option value="{{ $job->job_id }}" {{ old('job_id') == $job->job_id ? 'selected' : '' }}>
                                        {{ $job->job_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 2. Nama Lengkap Pelamar -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Masukkan nama lengkap Anda" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 3. Jenis Kelamin -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jk" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- 4. Alamat Email -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 5. Sumber Informasi Pekerjaan -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Sumber Informasi Lowongan <span class="text-red-500">*</span></label>
                            <select name="job_source_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white" required>
                                <option value="">-- Pilih Sumber Informasi --</option>
                                @foreach($sources as $source)
                                    <option value="{{ $source->job_source_id }}" {{ old('job_source_id') == $source->job_source_id ? 'selected' : '' }}>
                                        {{ $source->job_source_name ?? $source->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 6. Upload Berkas CV / Resume -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Unggah Berkas CV / Resume <span class="text-red-500">*</span> <small class="text-slate-400 font-normal">(Format PDF/DOC/DOCX, Max 5MB)</small></label>
                            <input type="file" name="cv_file" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 border border-slate-200 rounded-xl p-1" required>
                        </div>

                        <!-- 7. Catatan / Pesan Singkat -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Catatan Tambahan / Perkenalan Singkat</label>
                            <textarea name="note" rows="3" placeholder="Tuliskan pengalaman relevan atau pesan perkenalan singkat kepada HRD..." class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs">{{ old('note') }}</textarea>
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <button type="reset" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                            Reset Form
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2 cursor-pointer transform hover:-translate-y-0.5">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Kirim Berkas Lamaran</span>
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @include('partials.footer')

    {{-- JS AOS & SCRIPT OTO-SELECT JOB --}}
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

        function selectJob(jobId, jobTitle) {
            const selectElem = document.getElementById('job_id');
            if (selectElem) {
                selectElem.value = jobId;
            }

            const formElem = document.getElementById('form-lamaran');
            if (formElem) {
                formElem.scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>
</body>
</html>
