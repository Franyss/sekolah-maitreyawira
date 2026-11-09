{{-- File: resources/views/data/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data - {{ ucfirst($tableName ?? 'Database') }}</title>

    {{-- Asset Vite & Fallback CDN --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex min-h-screen font-sans">

    <!-- Partial Sidebar -->
    @include('partials.sidebar')

    <!-- Container Utama -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Header Navigasi -->
        <header class="bg-white px-8 py-4 flex items-center justify-between border-b border-gray-200">
            <div class="flex items-center gap-3">
                <h1 class="text-lg font-bold text-gray-800">
                    Tabel Aktif: <span class="text-indigo-600 font-extrabold uppercase">{{ $tableName ?? 'User' }}</span>
                </h1>
            </div>
            @if(isset($tableName))
                <a href="{{ route('data.create', $tableName) }}"
                   class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold rounded-xl transition-all flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Data Baru</span>
                </a>
            @endif
        </header>

        <!-- Main Body -->
        <main class="p-8 overflow-y-auto flex-grow">

            <!-- Alert Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs rounded-xl flex items-center gap-3 shadow-xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg shrink-0"></i>
                    <div>
                        <strong class="font-bold block">Berhasil!</strong>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Alert Notifikasi Error -->
            @if(session('error'))
                <div class="mb-5 p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs rounded-xl flex items-center gap-3 shadow-xs">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg shrink-0"></i>
                    <div>
                        <strong class="font-bold block">Terjadi Kesalahan!</strong>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @if(isset($tableName) && count($columns) > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                    <!-- Header Ringkasan Tabel & Form Pencarian -->
                    <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-gray-50/50">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-table text-indigo-600 text-sm"></i>
                            <h2 class="font-bold text-gray-700 uppercase tracking-wider text-xs">
                                Data Tabel: {{ $tableName }} <span class="text-gray-400">({{ $rows->total() }} Total Record)</span>
                            </h2>
                        </div>

                        <!-- Form Pencarian -->
                        <form action="{{ route('data.index', $tableName) }}" method="GET" class="flex items-center gap-2">
                            <div class="relative flex-grow sm:flex-grow-0">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari data di tabel {{ $tableName }}..."
                                       class="pl-9 pr-4 py-2 bg-white border border-gray-200 text-xs rounded-xl focus:outline-none focus:border-indigo-500 w-full sm:w-64 shadow-xs">
                                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-gray-400 text-xs"></i>
                            </div>
                            <button type="submit" class="px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition-all shadow-xs flex items-center gap-1.5 cursor-pointer">
                                <span>Cari</span>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('data.index', $tableName) }}"
                                   class="px-3 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-semibold rounded-xl transition-all"
                                   title="Hapus pencarian">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Display Data Tabel -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-gray-600">
                            <thead class="bg-gray-100/80 text-gray-700 uppercase font-bold border-b border-gray-200 text-[11px] tracking-wider">
                                <tr>
                                    <th class="px-4 py-3 text-center w-24">Aksi</th>
                                    @foreach($columns as $col)
                                        <th class="px-4 py-3 whitespace-nowrap">{{ str_replace('_', ' ', $col) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($rows as $row)
                                    <tr class="hover:bg-indigo-50/30 transition-colors">
                                        <!-- Tombol Aksi Edit & Hapus -->
                                        <td class="px-4 py-3 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('data.edit', [$tableName, $row->$primaryKey]) }}"
                                                   class="p-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-lg transition-colors"
                                                   title="Edit Data">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <form action="{{ route('data.destroy', [$tableName, $row->$primaryKey]) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus record ini?');"
                                                      class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg transition-colors"
                                                            title="Hapus Data">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                        <!-- Kolom-Kolom Data -->
                                        @foreach($columns as $col)
                                            @php
                                                $cellValue = $row->$col ?? '';
                                                $colLower = strtolower($col);
                                                $isImage = preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $cellValue) || Str::contains($colLower, ['image', 'img', 'photo', 'foto', 'logo', 'avatar']);
                                            @endphp

                                            <td class="px-4 py-3 whitespace-nowrap max-w-xs">
                                                @if($isImage && !empty($cellValue) && !is_numeric($cellValue))
                                                    <div class="flex items-center gap-2">
                                                        <img src="{{ asset('storage/' . $cellValue) }}"
                                                             alt="Preview"
                                                             class="w-8 h-8 object-cover rounded-lg border border-gray-200 shadow-xs"
                                                             onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'text-gray-400 font-mono text-[11px]\'>{{ Str::limit($cellValue, 20) }}</span>';">
                                                        <span class="text-gray-500 font-mono text-[11px] truncate max-w-[120px]">{{ $cellValue }}</span>
                                                    </div>
                                                @else
                                                    <span class="truncate block max-w-xs" title="{{ $cellValue }}">
                                                        {{ Str::limit($cellValue !== '' ? $cellValue : '-', 40) }}
                                                    </span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($columns) + 1 }}" class="text-center py-10 text-gray-400">
                                            <i class="fa-solid fa-folder-open text-3xl mb-2 text-gray-300 block"></i>
                                            @if(request('search'))
                                                <span>Tidak ditemukan data yang cocok dengan kata kunci "<strong>{{ request('search') }}</strong>".</span>
                                            @else
                                                <span>Tidak ada data pada tabel <strong>{{ $tableName }}</strong>.</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($rows->hasPages())
                        <div class="p-4 border-t border-gray-100 bg-gray-50/30">
                            {{ $rows->links() }}
                        </div>
                    @endif

                </div>
            @endif
        </main>
    </div>

</body>
</html>
