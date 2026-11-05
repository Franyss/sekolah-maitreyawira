{{-- File: resources/views/partials/navbar.blade.php --}}
<header class="bg-white border-b border-slate-200/80 sticky top-0 z-50 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

        <!-- LOGO BRAND SEKOLAH MAITREYAWIRA -->
        <a href="/" class="flex items-center gap-3 group shrink-0">
            <img src="{{ asset('images/logo-smw.png') }}"
                 alt="Logo Sekolah Maitreyawira Palembang"
                 class="h-12 sm:h-14 w-auto object-contain transition duration-200 group-hover:scale-105">
        </a>

        <!-- MENU NAVIGASI DESKTOP -->
        <nav class="hidden lg:flex items-center gap-1 font-bold text-xs text-[#1b2a6b]">
            @php
                // Ambil daftar sekolah dinamis dari tabel `school`
                $schools = \Illuminate\Support\Facades\DB::table('school')->get();
            @endphp

            @if(isset($mainMenus) && $mainMenus->count() > 0)
                {{-- NAVIGASI DINAMIS DARI DATABASE --}}
                @foreach($mainMenus as $main)
                    @php
                        $isSekolahMenu = str_contains(strtolower($main->title), 'sekolah') || $main->slug === 'sekolah';
                        $children = $subMenus->get($main->menu_id) ?? collect();
                        $path = ltrim($main->url ?? '', '/');

                        // Status Aktif Menu Induk
                        $isParentActive = request()->is($path ?: '/') ||
                                          ($isSekolahMenu && request()->is('sekolah*'));
                    @endphp

                    {{-- KHUSUS MENU SEKOLAH: Ambil Submenu dari Tabel `school` --}}
                    @if($isSekolahMenu)
                        <div class="relative group py-2">
                            <a href="/sekolah"
                               class="px-3 py-2 rounded-lg flex items-center gap-1 transition {{ request()->is('sekolah*') ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'hover:text-[#1b2a6b] hover:bg-slate-100/80' }}">
                                <span>{{ $main->title }}</span>
                                <svg class="w-3.5 h-3.5 text-[#1b2a6b]/70 group-hover:text-[#1b2a6b] transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>

                            <div class="absolute left-0 top-full -mt-1 pt-2 w-60 hidden group-hover:block transition duration-150 z-50">
                                <div class="bg-white rounded-xl shadow-xl border border-slate-100 py-2">
                                    @foreach($schools as $sch)
                                        @php $schUrl = '/sekolah/' . $sch->sch_slug; @endphp
                                        <a href="{{ $schUrl }}"
                                           class="block px-4 py-2 hover:bg-[#1b2a6b]/10 hover:text-[#1b2a6b] transition {{ request()->is('sekolah/' . $sch->sch_slug) ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'text-[#1b2a6b]' }}">
                                            {{ $sch->sch_name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    {{-- MENU LAIN DENGAN SUBMENU DARI `app_menu` --}}
                    @elseif($children->count() > 0)
                        <div class="relative group py-2">
                            <a href="{{ $main->url }}"
                               class="px-3 py-2 rounded-lg flex items-center gap-1 transition {{ $isParentActive ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'hover:text-[#1b2a6b] hover:bg-slate-100/80' }}">
                                <span>{{ $main->title }}</span>
                                <svg class="w-3.5 h-3.5 text-[#1b2a6b]/70 group-hover:text-[#1b2a6b] transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>

                            <div class="absolute left-0 top-full -mt-1 pt-2 w-60 hidden group-hover:block transition duration-150 z-50">
                                <div class="bg-white rounded-xl shadow-xl border border-slate-100 py-2">
                                    @foreach($children as $child)
                                        <a href="{{ $child->url }}"
                                           class="block px-4 py-2 hover:bg-[#1b2a6b]/10 hover:text-[#1b2a6b] transition {{ request()->is(ltrim($child->url, '/')) ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'text-[#1b2a6b]' }}">
                                            {{ $child->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    {{-- MENU TUNGGAL --}}
                    @else
                        <a href="{{ $main->url }}"
                           class="px-3 py-2 rounded-lg transition {{ request()->is($path ?: '/') ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'hover:text-[#1b2a6b] hover:bg-slate-100/80' }}">
                            {{ $main->title }}
                        </a>
                    @endif
                @endforeach
            @else
                {{-- FALLBACK STATIS JIKA DATABASE BELUM DIPANGGIL --}}
                <a href="/" class="px-3 py-2 rounded-lg transition {{ request()->is('/') ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'hover:bg-slate-100/80' }}">Beranda</a>
                <a href="/sejarah" class="px-3 py-2 rounded-lg transition {{ request()->is('sejarah*') ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'hover:bg-slate-100/80' }}">Tentang Kami</a>

                <div class="relative group py-2">
                    <a href="/sekolah"
                       class="px-3 py-2 rounded-lg flex items-center gap-1 transition {{ request()->is('sekolah*') ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'hover:text-[#1b2a6b] hover:bg-slate-100/80' }}">
                        <span>Sekolah</span>
                        <svg class="w-3.5 h-3.5 text-[#1b2a6b]/70 group-hover:text-[#1b2a6b] transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <div class="absolute left-0 top-full -mt-1 pt-2 w-60 hidden group-hover:block transition duration-150 z-50">
                        <div class="bg-white rounded-xl shadow-xl border border-slate-100 py-2">
                            @foreach($schools as $sch)
                                <a href="/sekolah/{{ $sch->sch_slug }}" class="block px-4 py-2 hover:bg-[#1b2a6b]/10 hover:text-[#1b2a6b] transition {{ request()->is('sekolah/' . $sch->sch_slug) ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : 'text-[#1b2a6b]' }}">
                                    {{ $sch->sch_name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="/pendaftaran-siswa" class="px-3 py-2 rounded-lg transition hover:bg-slate-100/80">Pendaftaran</a>
                <a href="/galeri" class="px-3 py-2 rounded-lg transition hover:bg-slate-100/80">Galeri</a>
                <a href="/berita" class="px-3 py-2 rounded-lg transition hover:bg-slate-100/80">Berita</a>
                <a href="/hubungi-kami" class="px-3 py-2 rounded-lg transition hover:bg-slate-100/80">Hubungi Kami</a>
            @endif
        </nav>

        <!-- TOMBOL LOGIN / AKUN & MOBILE BUTTON -->
        <div class="flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}"
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 bg-[#1b2a6b] hover:bg-[#111c4e] text-white font-black text-xs rounded-xl shadow-sm hover:shadow transition">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>LOGIN</span>
                </a>
            @else
                <a href="/data"
                   class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-blue-50 text-[#1b2a6b] font-extrabold text-xs rounded-xl border border-slate-200 transition">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                    </svg>
                    <span>Halaman Data</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="hidden sm:inline">
                    @csrf
                    <button type="submit"
                            class="px-3.5 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs transition border border-rose-200 cursor-pointer">
                        Keluar
                    </button>
                </form>
            @endguest

            <button id="mobile-menu-btn"
                    onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                    class="lg:hidden p-2 rounded-xl text-[#1b2a6b] hover:bg-slate-100 focus:outline-none transition cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- MENU MOBILE DROPDOWN -->
    <div id="mobile-menu"
         class="hidden lg:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-6 space-y-2 text-xs font-bold text-[#1b2a6b] shadow-xl">
        @if(isset($mainMenus) && $mainMenus->count() > 0)
            @foreach($mainMenus as $main)
                @php
                    $isSekolahMenu = str_contains(strtolower($main->title), 'sekolah') || $main->slug === 'sekolah';
                    $children = $subMenus->get($main->menu_id) ?? collect();
                @endphp

                @if($isSekolahMenu)
                    <div class="space-y-1 pl-3 border-l-2 border-slate-200">
                        <span class="block px-3 py-1 text-[11px] text-slate-400 uppercase tracking-wider font-extrabold">{{ $main->title }}</span>
                        @foreach($schools as $sch)
                            <a href="/sekolah/{{ $sch->sch_slug }}" class="block px-3 py-1.5 rounded-lg hover:bg-slate-100 {{ request()->is('sekolah/' . $sch->sch_slug) ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : '' }}">
                                {{ $sch->sch_name }}
                            </a>
                        @endforeach
                    </div>
                @elseif($children->count() > 0)
                    <div class="space-y-1 pl-3 border-l-2 border-slate-200">
                        <span class="block px-3 py-1 text-[11px] text-slate-400 uppercase tracking-wider font-extrabold">{{ $main->title }}</span>
                        @foreach($children as $child)
                            <a href="{{ $child->url }}" class="block px-3 py-1.5 rounded-lg hover:bg-slate-100 {{ request()->is(ltrim($child->url, '/')) ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : '' }}">
                                {{ $child->title }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <a href="{{ $main->url }}" class="block px-3 py-2 rounded-lg hover:bg-slate-100 {{ request()->is(ltrim($main->url, '/') ?: '/') ? 'text-[#1b2a6b] bg-[#1b2a6b]/10 font-extrabold' : '' }}">
                        {{ $main->title }}
                    </a>
                @endif
            @endforeach
        @else
            <a href="/" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Beranda</a>
            <a href="/sejarah" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Tentang Kami</a>

            <div class="space-y-1 pl-3 border-l-2 border-slate-200">
                <span class="block px-3 py-1 text-[11px] text-slate-400 uppercase tracking-wider font-extrabold">Sekolah</span>
                @foreach($schools as $sch)
                    <a href="/sekolah/{{ $sch->sch_slug }}" class="block px-3 py-1.5 rounded-lg hover:bg-slate-100">
                        {{ $sch->sch_name }}
                    </a>
                @endforeach
            </div>

            <a href="/pendaftaran-siswa" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Pendaftaran</a>
            <a href="/galeri" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Galeri</a>
            <a href="/berita" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Berita</a>
            <a href="/hubungi-kami" class="block px-3 py-2 rounded-lg hover:bg-slate-100">Hubungi Kami</a>
        @endif

        <div class="pt-2 border-t border-slate-100">
            @guest
                <a href="{{ route('login') }}" class="block w-full py-2.5 bg-[#1b2a6b] text-white font-black text-center rounded-xl shadow-xs">
                    LOGIN
                </a>
            @else
                <a href="/data" class="block w-full py-2.5 bg-blue-50 text-blue-700 font-extrabold text-center rounded-xl border border-blue-200 mb-2">
                    Halaman Data
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full py-2.5 bg-rose-50 text-rose-600 font-extrabold text-center rounded-xl border border-rose-200 cursor-pointer">
                        Keluar / Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</header>
