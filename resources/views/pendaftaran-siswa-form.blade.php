{{-- File: resources/views/pendaftaran-siswa-form.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pendaftaran SPMB Online | Sekolah Maitreyawira Palembang</title>

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
                <span class="text-amber-400">Portal SPMB Online</span>
            </nav>

            <h1 class="text-2xl sm:text-4xl font-black tracking-tight">
                Pendaftaran Peserta Didik Baru (PPDB / SPMB)
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm mt-1">
                Layanan Pendaftaran Siswa Baru Terpadu Sekolah Maitreyawira Palembang.
            </p>
        </div>
    </section>

    {{-- 3. KARTU PETUNJUK & TOMBOL REDIRECT SPMB --}}
    <section class="py-16 bg-slate-50 flex-grow flex items-center justify-center">
        <div class="max-w-2xl w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-md text-center space-y-6">

                <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mx-auto text-2xl shadow-xs">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>

                <div class="space-y-2">
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900">Portal SPMB Online Sekolah Maitreyawira</h2>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-lg mx-auto">
                        Pengisian formulir pendaftaran peserta didik baru (TK, SD, SMP, SMA) dilakukan secara terpusat melalui Sistem Penerimaan Murid Baru (SPMB) resmi.
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('pendaftaran-siswa.index') }}" class="w-full sm:w-auto px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition inline-flex items-center justify-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>

                    <a href="https://spmb.maitreyawira-palembang.sch.id"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-slate-900 font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 inline-flex items-center justify-center gap-2">
                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                        <span>Lanjut ke Formulir Pendaftaran SPMB</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                </div>

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
