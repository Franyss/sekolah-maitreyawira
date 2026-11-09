{{-- File: resources/views/partials/hero-banner.blade.php --}}
@props([
    'slug' => '',
    'badge' => '',
    'title' => '',
    'highlight' => '',
    'breadcrumbs' => []
])

@php
    $slug = $slug ?? '';
    $badge = $badge ?? '';
    $title = $title ?? '';
    $highlight = $highlight ?? '';
    $breadcrumbs = $breadcrumbs ?? [];

    // Ambil data menu berdasarkan slug
    $menu = \App\Models\AppMenu::where('slug', $slug)->first();
    $bgHeader = trim($menu->background_header ?? '');

    // Resolusi Path Gambar Background Header
    if (empty($bgHeader)) {
        $headerBgUrl = asset('images/slider-ppdb.jpg');
    } elseif (str_starts_with($bgHeader, 'http://') || str_starts_with($bgHeader, 'https://')) {
        $headerBgUrl = $bgHeader;
    } elseif (file_exists(public_path('storage/' . $bgHeader))) {
        $headerBgUrl = asset('storage/' . $bgHeader);
    } elseif (file_exists(public_path($bgHeader))) {
        $headerBgUrl = asset($bgHeader);
    } else {
        $headerBgUrl = asset('storage/' . $bgHeader);
    }

    $textColorClass = !empty($menu->font_color) ? $menu->font_color : 'text-white';
    $displayTitle = !empty($title) ? $title : ($menu->title ?? '');
@endphp

<section class="relative bg-slate-950 text-white overflow-hidden h-[300px] sm:h-[400px] lg:h-[480px] flex items-center">
    <!-- GAMBAR BACKGROUND DINAMIS DARI TABEL APP_MENU -->
    <div class="absolute inset-0 z-0">
        <img src="{{ $headerBgUrl }}"
             alt="Header Background"
             class="w-full h-full object-cover object-center"
             onerror="this.onerror=null; this.src='{{ asset('images/slider-ppdb.jpg') }}';">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/60 to-transparent z-10"></div>
    </div>

    <!-- KONTEN TEKS HERO & BREADCRUMB -->
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20" data-aos="fade-down" data-aos-duration="1000">
        @if(!empty($breadcrumbs) && is_array($breadcrumbs))
            <nav class="flex text-xs font-semibold text-slate-400 mb-4 gap-2 items-center flex-wrap">
                <a href="/" class="hover:text-amber-400 transition">Beranda</a>
                @foreach($breadcrumbs as $crumb)
                    <span>/</span>
                    @if(!empty($crumb['url']) && $crumb['url'] !== '#')
                        <a href="{{ $crumb['url'] }}" class="hover:text-amber-400 transition">{{ $crumb['label'] }}</a>
                    @else
                        <span class="text-amber-400">{{ $crumb['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        <div class="max-w-3xl space-y-4">
            @if(!empty($badge))
                <span class="inline-block px-3 py-1 rounded-full text-xs font-extrabold bg-amber-500/10 text-amber-400 border border-amber-500/30 uppercase tracking-widest">
                    {{ $badge }}
                </span>
            @endif

            <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight {{ $textColorClass }}">
                {{ $displayTitle }}
                @if(!empty($highlight))
                    <br>
                    <span class="text-amber-400 font-black drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">
                        {{ $highlight }}
                    </span>
                @endif
            </h1>
        </div>
    </div>
</section>
