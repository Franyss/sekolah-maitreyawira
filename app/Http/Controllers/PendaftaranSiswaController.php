<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceHour;

class PendaftaranSiswaController extends Controller
{
    /**
     * Halaman Informasi Utama PPDB
     */
    public function index()
    {
        $serviceHours = class_exists(\App\Models\ServiceHour::class)
            ? ServiceHour::all()
            : collect();

        return view('pendaftaran-siswa', compact('serviceHours'));
    }

    /**
     * Halaman Khusus Formulir Input Pendaftaran
     */
    public function form()
    {
        return view('pendaftaran-siswa-form');
    }
}
