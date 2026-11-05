<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses otentikasi user
     */
    public function login(Request $request)
    {
        $credentials =$request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember =$request->has('remember');

        if (Auth::attempt($credentials, $remember)) {$request->session()->regenerate();

            /** @var \App\Models\User $user */$user = Auth::user();

            // Cek status akun jika diperlukan
            if (isset($user->status) &&$user->status === 'inactive') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda sedang nonaktif. Silakan hubungi admin.']);
            }

            // Update waktu login terakhir ke tabel user
            $user->datetime_last_login = now();$user->save();

            // Mengarahkan langsung ke halaman /data setelah login berhasil
            return redirect()->intended('/data');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();$request->session()->regenerateToken();

        return redirect('/login');
    }
}
