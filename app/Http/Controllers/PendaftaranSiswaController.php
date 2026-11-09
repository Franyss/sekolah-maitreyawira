<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceHour;
use App\Models\AppMenu;

class PendaftaranSiswaController extends Controller
{
    /**
     * Halaman Informasi Utama PPDB
     */
    public function index()
    {
        // Ambil data konfigurasi PPDB dari tabel app_config
        $configs = DB::table('app_config')
            ->where('conf_key', 'LIKE', 'app_set_reg_%')
            ->pluck('conf_value', 'conf_key');

        // Ambil data jam operasional layanan sekretariat
        $serviceHours = class_exists(\App\Models\ServiceHour::class)
            ? ServiceHour::all()
            : collect();

        // Ambil data menu app_menu untuk halaman pendaftaran-siswa
        $menu = AppMenu::where('slug', 'pendaftaran-siswa')->first();

        return view('pendaftaran-siswa', compact('serviceHours', 'configs', 'menu'));
    }

    /**
     * Halaman Khusus Formulir Input Pendaftaran
     */
    public function form()
    {
        return view('pendaftaran-siswa-form');
    }
}
