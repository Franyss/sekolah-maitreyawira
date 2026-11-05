{{-- File: resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sekolah Maitreyawira Palembang</title>

    {{-- CSS AOS & Tailwind --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite('resources/css/app.css')
</head>
<body class="h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-slate-50 font-sans antialiased">

    <div class="sm:mx-auto sm:w-full sm:max-w-md" data-aos="fade-down" data-aos-duration="800">
        {{-- Logo & Judul --}}
        <div class="text-center space-y-2">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">
                Selamat Datang
            </h2>
            <p class="text-sm text-slate-500 font-medium">
                Masuk ke akun Anda untuk melanjutkan
            </p>
        </div>

        {{-- Form Card --}}
        <div class="mt-8 bg-white py-8 px-6 shadow-xl shadow-slate-200/50 rounded-2xl border border-slate-200/80 sm:px-10" data-aos="zoom-in" data-aos-delay="150">

            {{-- Alert Pesan Status / Error Umum --}}
            @if (session('status'))
                <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-700 font-semibold">
                    {{ session('status') }}
                </div>
            @endif

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <input id="email"
                               name="email"
                               type="email"
                               autocomplete="email"
                               required
                               value="{{ old('email') }}"
                               placeholder="nama@email.com"
                               class="w-full px-4 py-3 rounded-xl border @error('email') border-red-500 bg-red-50/30 @else border-slate-300 @enderror text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition duration-200">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Password --}}
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <input id="password"
                               name="password"
                               type="password"
                               autocomplete="current-password"
                               required
                               placeholder="••••••••"
                               class="w-full px-4 py-3 rounded-xl border @error('password') border-red-500 bg-red-50/30 @else border-slate-300 @enderror text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition duration-200">
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember"
                               name="remember"
                               type="checkbox"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded cursor-pointer">
                        <label for="remember" class="ml-2 block text-xs font-semibold text-slate-600 cursor-pointer">
                            Ingat Saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-xs">
                            <a href="{{ route('password.request') }}" class="font-bold text-blue-600 hover:text-blue-500 transition">
                                Lupa password?
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Tombol Submit --}}
                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3.5 px-4 rounded-xl shadow-md text-sm font-extrabold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                        Masuk Sekarang
                    </button>
                </div>
            </form>
        </div>

        {{-- Footer Link Kembalian --}}
        <p class="mt-6 text-center text-xs text-slate-500">
            Kembali ke <a href="/" class="font-bold text-blue-600 hover:underline">Halaman Utama</a>
        </p>
    </div>

    {{-- JS AOS --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
                easing: 'ease-out-cubic'
            });
        });
    </script>
</body>
</html>
