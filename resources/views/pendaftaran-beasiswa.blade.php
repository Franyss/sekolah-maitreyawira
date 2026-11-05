{{-- File: resources/views/pendaftaran-beasiswa.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa | Sekolah Maitreyawira Palembang</title>

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
    <section class="relative bg-slate-900 text-white overflow-hidden py-10 sm:py-14">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-blue-950/90 to-slate-900/80 z-10"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px] opacity-15"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <nav class="flex text-xs font-semibold text-slate-400 mb-3 gap-2 items-center">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                <span>/</span>
                <span class="text-amber-400">Pendaftaran Beasiswa</span>
            </nav>

            <div class="max-w-3xl space-y-2">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-amber-500/20 text-amber-300 border border-amber-500/30 uppercase tracking-widest">
                    Program Bantuan & Apresiasi Prestasi
                </span>
                <h1 class="text-2xl sm:text-4xl font-black tracking-tight">
                    Formulir Pengajuan Beasiswa Pendidikan
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm">
                    Silakan isi seluruh formulir pengajuan di bawah ini dengan data yang valid dan unggah dokumen pendukung.
                </p>
            </div>
        </div>
    </section>

    {{-- 3. FORMULIR PENDAFTARAN BEASISWA --}}
    <section class="py-10 bg-slate-50 flex-grow">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">

                <div class="border-b border-slate-100 pb-3 flex justify-between items-center">
                    <h2 class="text-lg font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-graduation-cap text-blue-600"></i>
                        <span>Isian Data Pengajuan Beasiswa</span>
                    </h2>
                </div>

                <!-- Alert Notifikasi Sukses / Gagal -->
                @if(session('success'))
                    <div class="p-4 text-xs text-emerald-800 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                        <div><strong>Berhasil!</strong> {{ session('success') }}</div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 text-xs text-rose-800 rounded-xl bg-rose-50 border border-rose-200 space-y-1">
                        <div class="font-bold flex items-center gap-2">
                            <i class="fa-solid fa-triangle-exclamation text-rose-600 text-base"></i>
                            <span>Terjadi kesalahan input:</span>
                        </div>
                        <ul class="list-disc list-inside pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Pendaftaran -->
                <form action="{{ route('pendaftaran-beasiswa.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-5 text-xs sm:text-sm">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <!-- 1. Tingkat / Jenjang -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Jenjang Pendidikan <span class="text-red-500">*</span></label>
                            <select name="jenjang" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white" required>
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="TK" {{ old('jenjang') == 'TK' ? 'selected' : '' }}>TK / KB</option>
                                <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>Sekolah Dasar (SD)</option>
                                <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>Sekolah Menengah Pertama (SMP)</option>
                                <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>Sekolah Menengah Atas (SMA)</option>
                            </select>
                        </div>

                        <!-- 2. Skema / ID Beasiswa (schs_id) -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Kategori Beasiswa</label>
                            <select name="schs_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs bg-white">
                                <option value="1" {{ old('schs_id') == 1 ? 'selected' : '' }}>Beasiswa Prestasi Akademik</option>
                                <option value="2" {{ old('schs_id') == 2 ? 'selected' : '' }}>Beasiswa Prestasi Non-Akademik / Seni & Olahraga</option>
                                <option value="3" {{ old('schs_id') == 3 ? 'selected' : '' }}>Beasiswa Bantuan Ekonomi</option>
                            </select>
                        </div>

                        <!-- 3. Nama Siswa -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Nama Lengkap Siswa <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" placeholder="Masukkan nama lengkap siswa" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 4. Tempat Lahir -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Kota Lahir" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 5. Tanggal Lahir -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 6. No HP/WA Siswa -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">No. HP / WA Siswa <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_hp_wa" value="{{ old('no_hp_wa') }}" placeholder="Contoh: 08123456789" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 7. Email -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 8. Nama Ayah -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Nama lengkap Ayah" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 9. Nama Ibu -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Nama lengkap Ibu" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 10. No WA Orang Tua -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">No. WA Orang Tua / Wali <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_wa" value="{{ old('no_wa') }}" placeholder="Contoh: 08123456789" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>
                        </div>

                        <!-- 11. Asal Sekolah -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" placeholder="Nama sekolah asal sebelumnya" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs">
                        </div>

                        <!-- 12. Alamat Lengkap -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Alamat Tempat Tinggal <span class="text-red-500">*</span></label>
                            <textarea name="alamat" rows="2" placeholder="Masukkan alamat domisili lengkap..." class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs" required>{{ old('alamat') }}</textarea>
                        </div>

                        <!-- 13. Deskripsi Prestasi -->
                        <div class="space-y-1 sm:col-span-2">
                            <label class="font-bold text-slate-700 block">Deskripsi Prestasi / Alasan Pengajuan Beasiswa</label>
                            <textarea name="desk_pres" rows="3" placeholder="Tuliskan prestasi yang pernah diraih atau pertimbangan alasan pengajuan beasiswa..." class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 text-xs">{{ old('desk_pres') }}</textarea>
                        </div>

                        <!-- 14. Upload Dokumen Pendukung (up_doc_bea) -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Unggah Dokumen Beasiswa <small class="text-slate-400 font-normal">(Sertifikat/Rapor/SKTM, Max 5MB)</small></label>
                            <input type="file" name="up_doc_bea" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 border border-slate-200 rounded-xl p-1">
                        </div>

                        <!-- 15. Upload Galeri / Foto Prestasi (gallery) -->
                        <div class="space-y-1">
                            <label class="font-bold text-slate-700 block">Unggah Foto Dokumentasi / Galeri <small class="text-slate-400 font-normal">(JPG/PNG, Max 5MB)</small></label>
                            <input type="file" name="gallery" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 border border-slate-200 rounded-xl p-1">
                        </div>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                        <button type="reset" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                            Reset Form
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Kirim Pendaftaran Beasiswa</span>
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
