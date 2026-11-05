{{-- File: resources/views/pendaftaran-siswa-form.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Siswa Baru | Sekolah Maitreyawira Palembang</title>

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
    <section class="relative bg-slate-900 text-white overflow-hidden py-10 sm:py-12">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <nav class="flex text-xs font-semibold text-slate-400 mb-3 gap-2 items-center">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('pendaftaran-siswa.index') }}" class="hover:text-amber-400 transition">Pendaftaran Siswa</a>
                <span>/</span>
                <span class="text-amber-400">Formulir Input Data</span>
            </nav>

            <h1 class="text-2xl sm:text-4xl font-black tracking-tight">
                Formulir Pendaftaran Peserta Didik Baru
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm mt-1">
                Silakan lengkapi data pendaftaran calon siswa di bawah ini.
            </p>
        </div>
    </section>

    {{-- 3. FORMULIR PENDAFTARAN --}}
    <section class="py-10 bg-slate-50 flex-grow">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">

                <div class="border-b border-slate-100 pb-3 flex justify-between items-center">
                    <h2 class="text-lg font-black text-slate-900">Input Data Pendaftaran</h2>
                    <a href="{{ route('pendaftaran-siswa.index') }}" class="text-xs font-bold text-blue-600 hover:underline flex items-center gap-1">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Informasi PPDB
                    </a>
                </div>

                <!-- Alert Container -->
                <div id="alert-container">
                    @if(session('success'))
                        <div class="p-4 mb-4 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                            <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="p-4 mb-4 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 flex items-center gap-2">
                            <i class="fa-solid fa-circle-exclamation text-rose-600 text-base"></i>
                            <div><strong>Gagal!</strong> {{ session('error') }}</div>
                        </div>
                    @endif
                </div>

                <!-- Form ke /data/student_reg -->
                <form id="registrationForm"
                      action="{{ route('data.store', 'student_reg') }}"
                      method="POST"
                      class="space-y-4 text-xs sm:text-sm">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- 1. Tahun Ajaran -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Tahun Ajaran <span class="text-red-500">*</span></label>
                            <input type="text" name="year_reg" value="{{ old('year_reg', '2026/2027') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 2. Tingkat -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Tingkat <span class="text-red-500">*</span></label>
                            <input type="text" name="jenjang" value="{{ old('jenjang') }}" placeholder="Contoh: SD / SMP / SMA" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 3. Gelombang -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Gelombang</label>
                            <input type="text" name="gelombang" value="{{ old('gelombang') }}" placeholder="Contoh: Gelombang 1" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs">
                        </div>

                        <!-- 4. No. Formulir -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-400 block">No. Formulir <span class="text-slate-400 text-[10px]">(Otomatis Sistem)</span></label>
                            <input type="text" name="no_formulir" placeholder="Otomatis" class="w-full px-3 py-2 rounded-xl border border-slate-100 bg-slate-100 text-slate-400 text-xs cursor-not-allowed" disabled>
                        </div>

                        <!-- 5. Tanggal -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Tanggal Pendaftaran <span class="text-red-500">*</span></label>
                            <input type="date" name="tgl_daftar" value="{{ old('tgl_daftar', date('Y-m-d')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 6. NISN -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">NISN</label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs">
                        </div>

                        <!-- 7. Nama Siswa -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Nama Siswa <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan Nama Lengkap Siswa" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 8. Jenis Kelamin -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenkel" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenkel') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenkel') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- 9. Tempat Lahir -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lhr" value="{{ old('tempat_lhr') }}" placeholder="Kota Lahir" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 10. Tanggal Lahir -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lhr" value="{{ old('tanggal_lhr', date('Y-m-d')) }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 11. Nama Ayah -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Masukkan Nama Ayah" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 12. Nama Ibu -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Masukkan Nama Ibu" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 13. Alamat -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Alamat <span class="text-red-500">*</span></label>
                            <textarea name="alamat" rows="2" placeholder="Masukkan Alamat Lengkap" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>{{ old('alamat') }}</textarea>
                        </div>

                        <!-- 14. No. Telepon -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">No. Telepon <span class="text-red-500">*</span></label>
                            <input type="tel" name="telepon" value="{{ old('telepon') }}" placeholder="Contoh: 08123456789" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 15. Asal Sekolah -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Asal Sekolah</label>
                            <input type="text" name="nama_asal_sek" value="{{ old('nama_asal_sek') }}" placeholder="Nama Sekolah Asal" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs">
                        </div>

                        <!-- 16. Kas -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Kas</label>
                            <input type="text" name="kas" value="{{ old('kas') }}" placeholder="Keterangan Kas" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:border-blue-600 text-xs">
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <button type="reset" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                            Reset
                        </button>
                        <button type="submit" id="btnSubmit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Simpan Pendaftaran (`student_reg`)</span>
                        </button>
                    </div>
                </form>

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

</body>
</html>
