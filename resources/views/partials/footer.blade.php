{{-- File: resources/views/partials/footer.blade.php --}}
@php
    // Ambil data kontak, logo, & sosial media dinamis dari tabel app_config dengan fallback otomatis
    $footerConfigs = $footerConfigs ?? \Illuminate\Support\Facades\DB::table('app_config')
        ->whereIn('conf_key', [
            'app_content_std_reg_email',
            'app_content_std_reg_wa',
            'app_content_std_reg_phone',
            'app_logo_white',
            'app_sm_fb',
            'app_sm_ig',
            'app_sm_yt',
            'app_sm_tw',
            'app_sm_wa'
        ])
        ->pluck('conf_value', 'conf_key');

    // Ambil data jam layanan (service_hour) yang aktif (sta = 1)
    $serviceHours = $serviceHours ?? \Illuminate\Support\Facades\DB::table('service_hour')
        ->where('sta', 1)
        ->orderBy('id', 'asc')
        ->get();

    // Data Kontak
    $email = $footerConfigs['app_content_std_reg_email'] ?? 'admin@maitreyawira-ds.sch.id';
    $phone = $footerConfigs['app_content_std_reg_phone'] ?? '6285362887968';

    // Data Sosial Media dari app_config
    $fbLink = $footerConfigs['app_sm_fb'] ?? 'https://www.facebook.com/SekolahMaitreyawira';
    $igLink = $footerConfigs['app_sm_ig'] ?? 'https://www.instagram.com/maitreyawira_palembang';
    $ytLink = $footerConfigs['app_sm_yt'] ?? 'https://www.youtube.com/c/SekolahMaitreyawira';
    $twLink = $footerConfigs['app_sm_tw'] ?? 'https://twitter.com/';
    $waRaw  = $footerConfigs['app_sm_wa'] ?? $footerConfigs['app_content_std_reg_wa'] ?? '085362887969';

    // Format nomor WhatsApp untuk link wa.me (menghapus karakter non-angka & ubah awalan 0 menjadi 62)
    $waNumber = preg_replace('/[^0-9]/', '', $waRaw);
    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }

    // Resolusi Jalur Gambar Logo dari app_logo_white
    $logoVal = trim($footerConfigs['app_logo_white'] ?? '');
    if (empty($logoVal)) {
        $footerLogoUrl = asset('images/logo-smw.png');
    } elseif (str_starts_with($logoVal, 'http://') || str_starts_with($logoVal, 'https://')) {
        $footerLogoUrl = $logoVal;
    } elseif (file_exists(public_path('storage/' . $logoVal))) {
        $footerLogoUrl = asset('storage/' . $logoVal);
    } elseif (file_exists(public_path($logoVal))) {
        $footerLogoUrl = asset($logoVal);
    } elseif (file_exists(public_path('uploads/app_config/' . basename($logoVal)))) {
        $footerLogoUrl = asset('uploads/app_config/' . basename($logoVal));
    } else {
        $footerLogoUrl = asset('storage/' . $logoVal);
    }
@endphp

<footer id="kontak" class="bg-slate-950 text-slate-400 pt-16 pb-8 border-t border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

        <!-- 1. LOGO, DESKRIPSI & SOSIAL MEDIA -->
        <div class="space-y-4">
            <a href="/" class="flex items-center gap-3 group shrink-0">
                <img src="{{ $footerLogoUrl }}"
                     alt="Logo Sekolah Maitreyawira Palembang"
                     class="h-12 sm:h-14 w-auto object-contain transition duration-200 group-hover:scale-105"
                     onerror="this.onerror=null; this.src='{{ asset('images/logo-smw.png') }}';">
            </a>
            <p class="text-xs leading-relaxed text-slate-300">
                Sekolah Maitreyawira Palembang senantiasa berikhtiar mencetak generasi penerus yang cerdas,
                berakhlak mulia, serta berbudaya kasih alam.
            </p>

            <!-- Ikon Sosial Media Warna Brand (Dinamis dari Database app_config) -->
            <div class="flex items-center gap-2.5 pt-2 flex-wrap">
                <!-- Facebook (app_sm_fb) -->
                @if(!empty($fbLink))
                    <a href="{{ $fbLink }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="w-9 h-9 rounded-full bg-[#1877F2] text-white flex items-center justify-center shadow-md hover:scale-110 transition duration-200"
                       title="Facebook">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                @endif

                <!-- Instagram (app_sm_ig) -->
                @if(!empty($igLink))
                    <a href="{{ $igLink }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="w-9 h-9 rounded-full bg-gradient-to-tr from-amber-500 via-rose-500 to-purple-600 text-white flex items-center justify-center shadow-md hover:scale-110 transition duration-200"
                       title="Instagram">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                @endif

                <!-- YouTube (app_sm_yt) -->
                @if(!empty($ytLink))
                    <a href="{{ $ytLink }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="w-9 h-9 rounded-full bg-[#FF0000] text-white flex items-center justify-center shadow-md hover:scale-110 transition duration-200"
                       title="YouTube">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                @endif

                <!-- Twitter / X (app_sm_tw) -->
                @if(!empty($twLink))
                    <a href="{{ $twLink }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="w-9 h-9 rounded-full bg-slate-800 hover:bg-slate-700 text-white flex items-center justify-center shadow-md hover:scale-110 transition duration-200"
                       title="Twitter / X">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                @endif

                <!-- WhatsApp (app_sm_wa) -->
                @if(!empty($waRaw))
                    <a href="https://wa.me/{{ $waNumber }}?text=Halo,%20Saya%20ingin%20bertanya%20terkait%20info%20Sekolah%20Maitreyawira"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="w-9 h-9 rounded-full bg-[#25D366] text-white flex items-center justify-center shadow-md hover:scale-110 transition duration-200"
                       title="WhatsApp">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </a>
                @endif
            </div>
        </div>

        <!-- 2. LINK PENTING -->
        <div>
            <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                Link Penting
            </h4>
            <ul class="space-y-2.5 text-xs">
                <li><a href="{{ url('/') }}" class="hover:text-amber-400 transition">Home / Beranda</a></li>
                <li><a href="{{ url('/galeri') }}" class="hover:text-amber-400 transition">Galeri</a></li>
                <li><a href="{{ url('/berita') }}" class="hover:text-amber-400 transition">Berita & Kegiatan</a></li>
                <li><a href="{{ url('/pendaftaran-siswa') }}" class="hover:text-amber-400 transition">Pendaftaran PPDB Online</a></li>
                <li><a href="{{ url('/hubungi-kami') }}" class="hover:text-amber-400 transition">Hubungi Kami</a></li>
            </ul>
        </div>

        <!-- 3. TENTANG KAMI -->
        <div>
            <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                Tentang Kami
            </h4>
            <ul class="space-y-2.5 text-xs">
                <li><a href="{{ url('/sejarah') }}" class="hover:text-amber-400 transition">Sejarah Sekolah</a></li>
                <li><a href="{{ url('/visi-misi-motto') }}" class="hover:text-amber-400 transition">Visi, Misi & Motto</a></li>
                <li><a href="{{ url('/program-unggulan') }}" class="hover:text-amber-400 transition">Program Unggulan</a></li>
                <li><a href="{{ url('/fasilitas') }}" class="hover:text-amber-400 transition">Fasilitas Sekolah</a></li>
                <li><a href="{{ url('/pencapaian') }}" class="hover:text-amber-400 transition">Pencapaian & Prestasi</a></li>
            </ul>
        </div>

        <!-- 4. HUBUNGI KAMI & JAM LAYANAN (DINAMIS DARI app_config & service_hour) -->
        <div>
            <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                Hubungi Kami
            </h4>
            <div class="space-y-3 text-xs">
                <p class="flex items-start gap-2">
                    <span class="shrink-0">📍</span>
                    <span>Jl. Residen Abdul Rozak, Palembang, Sumatera Selatan</span>
                </p>

                {{-- Telepon Dinamis (app_content_std_reg_phone) --}}
                <p class="flex items-center gap-2">
                    <span class="shrink-0">📞</span>
                    <a href="tel:{{ $phone }}" class="hover:text-amber-400 transition">{{ $phone }}</a>
                </p>

                {{-- WhatsApp Dinamis (app_sm_wa) --}}
                <p class="flex items-center gap-2">
                    <span class="shrink-0">💬</span>
                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer" class="hover:text-amber-400 transition">{{ $waRaw }}</a>
                </p>

                {{-- Email Dinamis (app_content_std_reg_email) --}}
                <p class="flex items-center gap-2">
                    <span class="shrink-0">✉️</span>
                    <a href="mailto:{{ $email }}" class="hover:text-amber-400 transition">{{ $email }}</a>
                </p>

                {{-- Jam Layanan Dinamis (tabel service_hour) --}}
                @if(isset($serviceHours) && count($serviceHours) > 0)
                    <div class="pt-1 space-y-1.5 border-t border-slate-900 mt-2">
                        @foreach($serviceHours as $sh)
                            <p class="flex items-start gap-2">
                                <span class="shrink-0">🕒</span>
                                <span>
                                    <strong class="text-slate-300 font-semibold">{{ $sh->service_day }}:</strong>
                                    {{ \Carbon\Carbon::parse($sh->hour_from)->format('H:i') }} - {{ \Carbon\Carbon::parse($sh->hour_to)->format('H:i') }} WIB
                                </span>
                            </p>
                        @endforeach
                    </div>
                @else
                    <p class="flex items-center gap-2 pt-1 border-t border-slate-900 mt-2">
                        <span class="shrink-0">🕒</span>
                        <span>Senin - Jumat: 08:00 - 16:00 WIB</span>
                    </p>
                @endif
            </div>
        </div>

    </div>

    <!-- HAK CIPTA (DI TENGAH) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 border-t border-slate-900 text-center text-xs text-slate-500">
        <p>© {{ date('Y') }} Sekolah Maitreyawira Palembang. All rights reserved.</p>
    </div>
</footer>
