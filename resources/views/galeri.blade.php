{{-- File: resources/views/galeri.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri & Dokumentasi | Sekolah Maitreyawira Palembang</title>

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
        slug="galeri"
        badge="Dokumentasi Kegiatan"
        title="Galeri Foto & Video"
        highlight="Sekolah Maitreyawira Palembang"
        :breadcrumbs="[
            ['label' => 'Media & Informasi', 'url' => '#'],
            ['label' => 'Galeri', 'url' => '']
        ]"
    />

    {{-- 3. KONTEN UTAMA & SIDEBAR --}}
    <section class="py-16 bg-slate-50 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-12 items-start">

                <!-- KONTEN UTAMA (8 Kolom) -->
                <main class="lg:col-span-8 space-y-8">

                    <!-- INTRO & FILTER TIPE (FOTO / VIDEO) -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-6" data-aos="fade-up">
                        <div class="border-b border-slate-100 pb-4">
                            <h2 class="text-2xl font-black text-slate-900">Album Foto & Video</h2>
                            <p class="text-xs text-blue-600 font-bold uppercase tracking-wider mt-1">Satu Kasih, Beragam Momen</p>
                        </div>

                        <!-- Kategori Filter Badges Sesuai Kolom 'type' -->
                        <div class="flex flex-wrap gap-2 text-xs font-bold">
                            <a href="{{ route('galeri.index', array_filter(['q' => request('q')])) }}"
                               class="px-4 py-2 rounded-xl transition {{ !request('type') ? 'bg-[#1b2a6b] text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                Semua Momen
                            </a>
                            <a href="{{ route('galeri.index', array_filter(['type' => 'image', 'q' => request('q')])) }}"
                               class="px-4 py-2 rounded-xl transition inline-flex items-center gap-1.5 {{ request('type') == 'image' ? 'bg-[#1b2a6b] text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                <i class="fa-solid fa-camera"></i>
                                <span>Foto & Gambar</span>
                            </a>
                            <a href="{{ route('galeri.index', array_filter(['type' => 'video-embed', 'q' => request('q')])) }}"
                               class="px-4 py-2 rounded-xl transition inline-flex items-center gap-1.5 {{ request('type') == 'video-embed' ? 'bg-[#1b2a6b] text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-600' }}">
                                <i class="fa-solid fa-video"></i>
                                <span>Video Dokumentasi</span>
                            </a>
                        </div>
                    </div>

                    {{-- HEADER INFORMASI GRID --}}
                    <div class="flex flex-wrap items-center justify-between border-b border-slate-200 pb-3 gap-2" data-aos="fade-up">
                        <h3 class="text-xl font-black text-slate-900">Dokumentasi Momen</h3>
                        @if($galleries->total() > 0)
                            <span class="text-xs text-slate-500 font-medium">
                                Halaman <span class="font-bold text-blue-600">{{ $galleries->currentPage() }}</span> dari <span class="font-bold text-slate-700">{{ $galleries->lastPage() }}</span> (Total {{ $galleries->total() }} Momen)
                            </span>
                        @else
                            <span class="text-xs text-slate-500 font-medium">Menampilkan dokumentasi terbaru</span>
                        @endif
                    </div>

                    <!-- GRID DOKUMENTASI GALERI (DINAMIS DATABASE) -->
                    <div class="grid sm:grid-cols-2 gap-6">
                        @forelse($galleries as $item)
                            @php
                                $file = trim($item->file ?? '');
                                $fileName = basename($file);
                                $isVideo = ($item->type === 'video-embed') || str_contains($file, 'youtube.com') || str_contains($file, 'youtu.be');

                                if ($isVideo) {
                                    // Ambil ID Video YouTube dari kolom 'file' atau tautan
                                    preg_match('/(?:v=|\/)([a-zA-Z0-9_-]{11})/', $file, $matches);
                                    $ytId = $matches[1] ?? '';
                                    $imgUrl = !empty($ytId)
                                        ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg"
                                        : 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80';
                                } else {
                                    // Jalur Gambar 3 Lapis (Local Uploads -> Local Storage -> Remote Fallback)
                                    if (!empty($fileName) && file_exists(public_path('uploads/gallery/' . $fileName))) {
                                        $imgUrl = asset('uploads/gallery/' . $fileName);
                                    } elseif (!empty($fileName) && file_exists(public_path('storage/gallery/' . $fileName))) {
                                        $imgUrl = asset('storage/gallery/' . $fileName);
                                    } elseif (!empty($fileName)) {
                                        $imgUrl = 'https://maitreyawira-palembang.sch.id/uploads/gallery/' . $fileName;
                                    } else {
                                        $imgUrl = 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=800&q=80';
                                    }
                                }
                            @endphp

                            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between group"
                                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 100 }}">
                                <div>
                                    <!-- WADAH GAMBAR / THUMBNAIL VIDEO -->
                                    <div class="h-48 bg-slate-100 overflow-hidden relative">
                                        <img src="{{ $imgUrl }}"
                                             alt="{{ $item->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                             loading="lazy"
                                             @if(!$isVideo) onerror="this.onerror=null; this.src='https://maitreyawira-palembang.sch.id/uploads/gallery/{{ $fileName }}';" @endif>

                                        <!-- BADGE TIPE ('image' / 'video-embed') -->
                                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-white text-[10px] font-bold backdrop-blur-xs uppercase tracking-wider flex items-center gap-1 {{ $isVideo ? 'bg-red-600' : 'bg-slate-900/80' }}">
                                            @if($isVideo)
                                                <i class="fa-solid fa-play text-[9px]"></i> Video
                                            @else
                                                <i class="fa-solid fa-image text-[9px]"></i> Foto
                                            @endif
                                        </span>

                                        <!-- OVERLAY THUMBNAIL VIDEO & TOMBOL PLAY SESUAI GAMBAR REFERENSI -->
                                        @if($isVideo)
                                            <a href="{{ str_starts_with($file, 'http') ? $file : 'https://www.youtube.com/watch?v=' . $file }}"
                                               target="_blank"
                                               class="absolute inset-0 bg-slate-950/30 flex items-center justify-center group-hover:bg-slate-950/40 transition">
                                                <!-- LINGKARAN BIRU DENGAN TRIANGLE HITAM PRESISI -->
                                                <div class="w-14 h-14 rounded-full bg-[#5057e5] hover:bg-[#4349d6] flex items-center justify-center shadow-xl group-hover:scale-110 transition duration-300 pl-1">
                                                    <svg class="w-6 h-6 text-slate-950 fill-current" viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z"/>
                                                    </svg>
                                                </div>
                                            </a>
                                        @endif
                                    </div>

                                    <!-- KONTEN JUDUL & DESKRIPSI -->
                                    <div class="p-5 space-y-2">
                                        <h3 class="text-base font-bold text-slate-900 group-hover:text-blue-600 transition leading-snug">
                                            {{ $item->title }}
                                        </h3>
                                        @if(!empty($item->description))
                                            <p class="text-slate-600 text-xs leading-relaxed line-clamp-2">
                                                {{ strip_tags($item->description) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="sm:col-span-2 bg-white rounded-2xl p-12 text-center text-slate-400 italic border border-dashed border-slate-200">
                                Belum ada data galeri yang ditambahkan di database.
                            </div>
                        @endforelse
                    </div>

                    <!-- NAVIGASI HALAMAN (DETAIL TERPUSAT DI TENGAH) -->
                    @if($galleries->hasPages())
                        <div class="flex items-center justify-between border-t border-slate-200 pt-6 mt-8" data-aos="fade-up">

                            {{-- Tombol Previous --}}
                            @if ($galleries->onFirstPage())
                                <span class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-400 font-bold text-xs cursor-not-allowed flex items-center gap-1 select-none border border-slate-200/60">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    <span>Sebelumnya</span>
                                </span>
                            @else
                                <a href="{{ $galleries->previousPageUrl() }}"
                                   class="px-4 py-2.5 rounded-xl bg-white border border-slate-200/80 text-slate-700 font-bold text-xs hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition flex items-center gap-1 shadow-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    <span>Sebelumnya</span>
                                </a>
                            @endif

                            {{-- Detail Informasi Halaman (DI TENGAH) --}}
                            <div class="text-xs font-semibold text-slate-600 bg-white px-4 py-2 rounded-xl border border-slate-200/80 shadow-xs flex items-center gap-1.5">
                                <span>Halaman</span>
                                <span class="font-black text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100">
                                    {{ $galleries->currentPage() }}
                                </span>
                                <span>dari</span>
                                <span class="font-black text-slate-800">
                                    {{ $galleries->lastPage() }}
                                </span>
                            </div>

                            {{-- Tombol Next --}}
                            @if ($galleries->hasMorePages())
                                <a href="{{ $galleries->nextPageUrl() }}"
                                   class="px-4 py-2.5 rounded-xl bg-white border border-slate-200/80 text-slate-700 font-bold text-xs hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition flex items-center gap-1 shadow-xs">
                                    <span>Berikutnya</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @else
                                <span class="px-4 py-2.5 rounded-xl bg-slate-100 text-slate-400 font-bold text-xs cursor-not-allowed flex items-center gap-1 select-none border border-slate-200/60">
                                    <span>Berikutnya</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            @endif

                        </div>
                    @endif

                </main>

                <!-- SIDEBAR NAVIGASI & INFORMASI (4 Kolom) -->
                <aside class="lg:col-span-4 space-y-6 sticky top-28" data-aos="fade-left" data-aos-delay="200">

                    <!-- WIDGET CARI GALERI / DOKUMENTASI -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-3">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Cari Dokumentasi</h3>
                        <form action="{{ route('galeri.index') }}" method="GET" class="relative">
                            @if(request('type'))
                                <input type="hidden" name="type" value="{{ request('type') }}">
                            @endif

                            <input type="text"
                                   name="q"
                                   value="{{ request('q') }}"
                                   placeholder="Kata kunci foto/video..."
                                   class="w-full px-4 py-2.5 pl-10 pr-8 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 text-xs">

                            <button type="submit" class="absolute left-3 top-3 text-slate-400 hover:text-blue-600 cursor-pointer" title="Cari">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>

                            @if(request('q'))
                                <a href="{{ route('galeri.index', array_filter(['type' => request('type')])) }}"
                                   class="absolute right-3 top-2.5 text-slate-400 hover:text-rose-500 font-bold text-xs"
                                   title="Hapus pencarian">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Menu Navigasi Sub-Halaman Media -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">
                            Media & Informasi
                        </h3>
                        <nav class="flex flex-col gap-1 text-xs font-bold text-slate-600">
                            <a href="/galeri" class="flex items-center justify-between p-2.5 rounded-lg bg-blue-50 text-blue-600 font-extrabold">
                                <span>Galeri & Dokumentasi</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="/berita" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-slate-50 hover:text-blue-600 transition">
                                <span>Berita & Pengumuman</span>
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </nav>
                    </div>

                    <!-- Widget PPDB Call-to-Action -->
                    <div class="bg-gradient-to-br from-amber-400 to-amber-500 rounded-2xl p-6 text-slate-900 shadow-md space-y-4" data-aos="fade-up">
                        <div class="font-black text-lg leading-tight">
                            Bergabung Bersama Keluarga Maitreyawira!
                        </div>
                        <p class="text-xs text-slate-800 font-medium leading-relaxed">
                            Pendaftaran Murid Baru (PPDB) T.A 2026/2027 telah dibuka untuk jenjang TK, SD, SMP, dan SMA.
                        </p>
                        <a href="/pendaftaran-siswa" class="inline-block w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-800 text-amber-400 font-extrabold text-xs text-center rounded-xl shadow-xs transition">
                            Daftar PPDB Online Sekarang
                        </a>
                    </div>

                </aside>

            </div>
        </div>
    </section>

    {{-- 4. FOOTER PARTIAL --}}
    @include('partials.footer')

    {{-- JS AOS --}}
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
