{{-- File: resources/views/data/form.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isEdit ? 'Edit Data' : 'Tambah Data' }} - {{ ucfirst($tableName) }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex min-h-screen font-sans">

    @include('partials.sidebar')

    <div class="flex-1 flex flex-col min-w-0">

        <header class="bg-white px-8 py-4 flex items-center justify-between border-b border-gray-200">
            <div class="flex items-center gap-3">
                <a href="{{ route('data.index', $tableName) }}" class="p-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="text-lg font-bold text-gray-800">
                    {{ $isEdit ? 'Edit Data' : 'Tambah Data Baru' }}: <span class="text-indigo-600 font-extrabold uppercase">{{ $tableName }}</span>
                </h1>
            </div>
        </header>

        <main class="p-8 overflow-y-auto flex-grow max-w-4xl">

            @if(session('error'))
                <div class="mb-5 p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg"></i>
                    <div>
                        <strong class="font-bold block">Terjadi Kesalahan!</strong>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">

                <form action="{{ $isEdit ? route('data.update', [$tableName, $row->$primaryKey]) : route('data.store', $tableName) }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-6 text-xs sm:text-sm">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    @foreach($formColumns as $col)
                        @php
                            $val = old($col, $row->$col ?? '');
                            $colLower = strtolower($col);

                            $isImageOrFile = preg_match('/(^up_|file|image|img|photo|foto|logo|icon|upload|avatar|gallery|dok|doc|pdf|raport|ijazah|nisn|akte|kk|ktp|payment|thumb|thumbnail|header|bg|background|banner|attachment)/i', $colLower);
                            $isConfigValue = ($tableName === 'app_config' && $col === 'conf_value');
                            $isProgramDetailContent = ($tableName === 'program_detail' && $col === 'program_detail_content');
                        @endphp

                        <div class="space-y-1">
                            <label class="font-bold text-gray-700 block uppercase tracking-wider text-xs">
                                {{ str_replace('_', ' ', $col) }}
                            </label>

                            {{-- KONDISI 1: TABEL APP_CONFIG (CONF_VALUE) ATAU PROGRAM_DETAIL (PROGRAM_DETAIL_CONTENT) - DUAL INPUT: TEKS + UPLOAD GAMBAR --}}
                            @if($isConfigValue || $isProgramDetailContent)
                                <div class="space-y-3 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                    <div>
                                        <label class="text-[11px] font-semibold text-slate-500 block mb-1">Opsi A: Isian Teks / Konten Deskripsi</label>
                                        <textarea name="{{ $col }}" rows="3" placeholder="Masukkan teks atau nama berkas..." class="w-full px-3 py-2 bg-white border border-gray-200 rounded-xl focus:border-indigo-500 text-xs">{{ $val }}</textarea>
                                    </div>

                                    <div class="border-t border-slate-200 pt-3">
                                        <label class="text-[11px] font-semibold text-slate-500 block mb-1">Opsi B: Unggah Berkas / Gambar Baru (Pilih file jika ingin mengunggah gambar/dokumen)</label>
                                        <input type="file" name="{{ $col }}_file" class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 border border-gray-200 rounded-xl p-1 bg-white">
                                    </div>

                                    @if(!empty($val))
                                        @php
                                            $fileName = basename($val);
                                            $isImg = preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $val) || str_starts_with($fileName, 'program-');
                                            if (file_exists(public_path('uploads/program/' . $fileName))) {
                                                $imgSrc = asset('uploads/program/' . $fileName);
                                            } elseif (file_exists(public_path('uploads/program_detail/' . $fileName))) {
                                                $imgSrc = asset('uploads/program_detail/' . $fileName);
                                            } elseif (file_exists(public_path('storage/' . $val))) {
                                                $imgSrc = asset('storage/' . $val);
                                            } elseif (str_starts_with($val, 'http')) {
                                                $imgSrc = $val;
                                            } else {
                                                $imgSrc = asset('storage/' . $val);
                                            }
                                        @endphp
                                        <div class="mt-2 text-[11px] text-gray-500 flex items-center gap-2 border-t border-slate-200 pt-2">
                                            <span>Nilai / File Saat Ini:</span>
                                            <code class="bg-gray-200 px-2 py-0.5 rounded text-gray-800 font-mono">{{ $val }}</code>
                                            @if($isImg)
                                                <img src="{{ $imgSrc }}" alt="Preview" class="h-10 w-10 object-cover rounded border bg-white" onerror="this.style.display='none';">
                                            @endif
                                        </div>
                                    @endif
                                </div>

                            {{-- KONDISI 2: FIELD BERKAS / GAMBAR / THUMBNAIL / HEADER (SUPPORTS UPLOAD FILE) --}}
                            @elseif($isImageOrFile)
                                <div class="space-y-2">
                                    @if(!empty($val))
                                        <div class="flex items-center gap-3 p-2.5 border border-gray-200 rounded-xl bg-slate-50">
                                            @if(preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $val) || Str::contains($colLower, ['thumb', 'photo', 'img', 'image', 'foto', 'header', 'bg', 'background', 'banner', 'logo', 'icon']))
                                                <img src="{{ str_starts_with($val, 'http') ? $val : asset('storage/' . $val) }}"
                                                     alt="Preview"
                                                     class="w-12 h-12 object-cover rounded-lg border bg-white shrink-0"
                                                     onerror="this.style.display='none';">
                                            @else
                                                <div class="w-9 h-9 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                                                    <i class="fa-solid fa-file-lines text-sm"></i>
                                                </div>
                                            @endif
                                            <div class="min-w-0 flex-1">
                                                <span class="text-[11px] font-semibold text-gray-700 block truncate">{{ basename($val) }}</span>
                                                <a href="{{ str_starts_with($val, 'http') ? $val : asset('storage/' . $val) }}" target="_blank" class="text-[10px] text-indigo-600 hover:underline inline-flex items-center gap-1 font-bold">
                                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Berkas / Gambar Saat Ini
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" name="{{ $col }}" class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 border border-gray-200 rounded-xl p-1 bg-white">
                                </div>

                            {{-- KONDISI 3: FIELD PASSWORD --}}
                            @elseif($colLower === 'password')
                                <input type="password" name="{{ $col }}" placeholder="{{ $isEdit ? 'Kosongkan jika tidak ingin diubah' : 'Masukkan password' }}" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:border-indigo-500 text-xs">

                            {{-- KONDISI 4: FIELD TEKS PANJANG (DESKRIPSI/ALAMAT/ISI POST) --}}
                            @elseif(Str::contains($colLower, ['desc', 'detail', 'content', 'address', 'alamat', 'note', 'text']))
                                <textarea name="{{ $col }}" rows="5" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:border-indigo-500 text-xs">{{ $val }}</textarea>

                            {{-- KONDISI 5: FIELD INPUT BIASA --}}
                            @else
                                <input type="text" name="{{ $col }}" value="{{ $val }}" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:border-indigo-500 text-xs">
                            @endif
                        </div>
                    @endforeach

                    <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('data.index', $tableName) }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-xl transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>{{ $isEdit ? 'Simpan Perubahan' : 'Tambah Data' }}</span>
                        </button>
                    </div>

                </form>

            </div>
        </main>
    </div>

</body>
</html>
