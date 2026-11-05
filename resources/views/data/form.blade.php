{{-- File: resources/views/data/form.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isEdit ? 'Edit Data' : 'Tambah Data' }} - {{ $tableName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex min-h-screen font-sans">

    <!-- Partial Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Header Navigasi -->
        <header class="bg-white px-8 py-4 flex items-center justify-between border-b border-gray-200">
            <h1 class="text-lg font-bold text-gray-800">
                {{ $isEdit ? 'Form Edit Data' : 'Form Tambah Data' }}
            </h1>
            <a href="{{ route('data.index', ['table' => $tableName]) }}"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-semibold rounded-lg transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Tabel
            </a>
        </header>

        <main class="p-8 overflow-y-auto">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 p-6">

                <!-- Peringatan Error Duplikat / Query -->
                @if (session('error'))
                    <div
                        class="mb-5 p-4 bg-rose-100 border border-rose-200 text-rose-800 text-xs rounded-xl flex items-center gap-3">
                        <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg"></i>
                        <div>
                            <strong class="font-bold">Peringatan:</strong>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $isEdit ? 'Ubah Record Pada Tabel: ' : 'Tambah Record Baru Ke Tabel: ' }}
                        <span class="text-indigo-600 uppercase">{{ $tableName }}</span>
                    </h2>
                </div>

                <!-- Form Dynamic -->
                <form
                    action="{{ $isEdit ? route('data.update', [$tableName, $row->$primaryKey]) : route('data.store', $tableName) }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @if ($isEdit)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach ($formColumns as $column)
                            @php
                                $val = $isEdit ? $row->$column ?? '' : '';
                                $colLower = strtolower($column);

                                // Deteksi Textarea (Teks Panjang)
                                $isTextArea = Str::contains($colLower, [
                                    'desc',
                                    'detail',
                                    'content',
                                    'address',
                                    'alamat',
                                    'keterangan',
                                    'speech',
                                    'note',
                                    'spesification',
                                ]);

                                // Deteksi Berkas & Gambar (Kriteria Diperluas)
                                $isFile = Str::contains($colLower, [
                                    'file',
                                    'image',
                                    'img',
                                    'photo',
                                    'foto',
                                    'logo',
                                    'icon',
                                    'upload',
                                    'up_',
                                    'pic',
                                    'picture',
                                    'avatar',
                                    'thumb',
                                    'banner',
                                    'cover',
                                    'poster',
                                    'header',
                                    'background',
                                    'bg',
                                    'doc',
                                    'pdf',
                                    'cv',
                                ]);

                                // Deteksi Password
                                $isPassword = Str::contains($colLower, ['password', 'pass']);
                            @endphp

                            <div class="{{ $isTextArea ? 'md:col-span-2' : '' }}">
                                <label for="{{ $column }}"
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                    {{ str_replace('_', ' ', $column) }}
                                </label>

                                @if ($isTextArea)
                                    <textarea id="{{ $column }}" name="{{ $column }}" rows="4"
                                        class="w-full p-3 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old($column, $val) }}</textarea>

                                @elseif($isFile)
                                    <div class="space-y-2">
                                        <input type="file" id="{{ $column }}" name="{{ $column }}"
                                            class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-lg p-1.5 cursor-pointer">

                                        @if ($isEdit && !empty($val))
                                            @php
                                                $isImgExt = preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $val) || Str::contains($colLower, ['image', 'img', 'photo', 'foto', 'logo', 'avatar', 'pic', 'thumb', 'cover', 'banner', 'bg', 'header']);

                                                if (Str::startsWith($val, ['http://', 'https://'])) {
                                                    $previewUrl = $val;
                                                } elseif (file_exists(public_path('storage/' . $val))) {
                                                    $previewUrl = asset('storage/' . $val);
                                                } else {
                                                    $previewUrl = asset($val);
                                                }
                                            @endphp

                                            <div class="flex items-center gap-3 p-2.5 bg-gray-50 rounded-xl border border-gray-200 mt-2">
                                                @if($isImgExt)
                                                    <img src="{{ $previewUrl }}" alt="Preview"
                                                         class="w-12 h-12 object-cover rounded-lg border border-gray-200 shrink-0 bg-white"
                                                         onerror="this.style.display='none';">
                                                @endif
                                                <div class="text-[11px] text-gray-600 truncate">
                                                    <span class="font-bold text-gray-700 block">Berkas / Gambar Saat Ini:</span>
                                                    <span class="text-indigo-600 font-mono truncate block max-w-xs" title="{{ $val }}">{{ $val }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                @elseif($isPassword)
                                    <input type="password" id="{{ $column }}" name="{{ $column }}"
                                        placeholder="{{ $isEdit ? 'Kosongkan jika tidak ingin mengubah' : 'Masukkan password' }}"
                                        class="w-full p-2.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                                @else
                                    <input type="text" id="{{ $column }}" name="{{ $column }}"
                                        value="{{ old($column, $val) }}"
                                        class="w-full p-2.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Tombol Form -->
                    <div class="pt-6 mt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                        <a href="{{ route('data.index', ['table' => $tableName]) }}"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-semibold rounded-lg transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg shadow-sm transition-colors flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-floppy-disk"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Data' }}
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>

</body>

</html>
