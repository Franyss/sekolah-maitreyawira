<!-- resources/views/partials/sidebar.blade.php -->
<aside class="w-64 bg-[#1b1b2f] text-gray-300 flex flex-col justify-between shrink-0 min-h-screen">
    <div>
        <!-- Profile Header -->
        <div class="flex flex-col items-center py-6 border-b border-gray-700/50">
            <img src="https://ui-avatars.com/api/?name=Admin+Maitreyawira&background=0D8ABC&color=fff"
                 alt="Avatar" class="w-14 h-14 rounded-xl border-2 border-indigo-400 mb-2 shadow-md">
            <h3 class="text-white font-semibold text-sm">Administrator</h3>
            <span class="text-[11px] text-gray-400">Sekolah Maitreyawira</span>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-4 text-xs overflow-y-auto max-h-[calc(100vh-140px)]">

            <!-- Dashboard -->
            <div>
                <a href="{{ route('data.index', 'app_slider') }}"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-lg {{ request()->is('data/app_slider') || request()->query('table') === 'app_slider' ? 'bg-emerald-500 text-white font-semibold' : 'hover:bg-white/5 hover:text-white transition-colors' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-gauge text-sm"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </div>

            <!-- Kategori: Pengguna & Akses -->
            <div>
                <span class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Pengguna & Akses</span>
                <div class="mt-1 space-y-0.5">
                    <a href="{{ url('/data/user') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/user') || request()->query('table') === 'user' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-users text-xs w-4"></i>
                            <span>Data Pengguna (`user`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/access') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/access') || request()->query('table') === 'access' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-shield-halved text-xs w-4"></i>
                            <span>Hak Akses (`access`)</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Kategori: Akademik & Kesiswaan -->
            <div>
                <span class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Akademik & Kesiswaan</span>
                <div class="mt-1 space-y-0.5">
                    <a href="{{ url('/data/school') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/school') || request()->query('table') === 'school' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-school text-xs w-4"></i>
                            <span>Unit Sekolah (`school`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/student_reg') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/student_reg') || request()->query('table') === 'student_reg' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-id-card text-xs w-4"></i>
                            <span>Pendaftaran (`student_reg`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/scholarship') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/scholarship') || request()->query('table') === 'scholarship' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-graduation-cap text-xs w-4"></i>
                            <span>Beasiswa (`scholarship`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/consultation_set') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/consultation_set') || request()->query('table') === 'consultation_set' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-comments text-xs w-4"></i>
                            <span>Konsultasi (`consultation_set`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/testimony') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/testimony*') || request()->query('table') === 'testimony' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-quote-left text-xs w-4"></i>
                            <span>Testimoni (`testimony`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/testimony_detail') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/testimony_detail*') || request()->query('table') === 'testimony_detail' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-quote-right text-xs w-4"></i>
                            <span>Detail Testimoni (`testimony_detail`)</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Kategori: Artikel & Informasi -->
            <div>
                <span class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Artikel & Berita</span>
                <div class="mt-1 space-y-0.5">
                    <a href="{{ url('/data/post') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/post') || request()->query('table') === 'post' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-newspaper text-xs w-4"></i>
                            <span>Berita & Post (`post`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/post_tag') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/post_tag') || request()->query('table') === 'post_tag' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-tags text-xs w-4"></i>
                            <span>Tag Berita (`post_tag`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/post_tag_detail') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/post_tag_detail*') || request()->query('table') === 'post_tag_detail' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-tag text-xs w-4"></i>
                            <span>Detail Tag (`post_tag_detail`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/post_school') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/post_school') || request()->query('table') === 'post_school' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-link text-xs w-4"></i>
                            <span>Relasi Unit (`post_school`)</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Kategori: Fasilitas & Galeri -->
            <div>
                <span class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Fasilitas & Galeri</span>
                <div class="mt-1 space-y-0.5">
                    <a href="{{ url('/data/facility') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/facility*') || request()->query('table') === 'facility' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-building text-xs w-4"></i>
                            <span>Fasilitas (`facility`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/gallery') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/gallery*') || request()->query('table') === 'gallery' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-images text-xs w-4"></i>
                            <span>Galeri Foto/Video (`gallery`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/history') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/history') || request()->query('table') === 'history' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-clock-rotate-left text-xs w-4"></i>
                            <span>Sejarah (`history`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/history_detail') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/history_detail*') || request()->query('table') === 'history_detail' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-timeline text-xs w-4"></i>
                            <span>Detail Sejarah (`history_detail`)</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Kategori: Rekrutmen / Karir -->
            <div>
                <span class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Rekrutmen (Karir)</span>
                <div class="mt-1 space-y-0.5">
                    <a href="{{ url('/data/job') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/job') || request()->query('table') === 'job' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-briefcase text-xs w-4"></i>
                            <span>Lowongan (`job`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/job_detail') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/job_detail') || request()->query('table') === 'job_detail' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-file-user text-xs w-4"></i>
                            <span>Pelamar (`job_detail`)</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Kategori: Konfigurasi Sistem -->
            <div>
                <span class="px-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Sistem</span>
                <div class="mt-1 space-y-0.5">
                    <a href="{{ url('/data/app_slider') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/app_slider') || request()->query('table') === 'app_slider' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-images text-xs w-4"></i>
                            <span>Slider Banner (`app_slider`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/app_config') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/app_config') || request()->query('table') === 'app_config' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-sliders text-xs w-4"></i>
                            <span>Pengaturan (`app_config`)</span>
                        </div>
                    </a>
                    <a href="{{ url('/data/app_menu') }}"
                       class="flex items-center justify-between px-3.5 py-2 rounded-lg {{ request()->is('data/app_menu') || request()->query('table') === 'app_menu' ? 'bg-indigo-600 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-bars-staggered text-xs w-4"></i>
                            <span>Menu App (`app_menu`)</span>
                        </div>
                    </a>
                </div>
            </div>

        </nav>
    </div>

    <!-- Bottom Actions: Tombol Logout -->
    <div class="p-4 border-t border-gray-700/50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full py-2 px-4 border border-rose-500/30 bg-rose-500/10 hover:bg-rose-600 text-rose-300 hover:text-white rounded-xl text-xs font-semibold transition-all flex items-center justify-center gap-2 cursor-pointer shadow-xs">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Keluar / Logout</span>
            </button>
        </form>
    </div>
</aside>
