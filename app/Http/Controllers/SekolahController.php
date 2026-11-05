<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SekolahController extends Controller
{
    /**
     * Menampilkan profil unit sekolah dinamis berdasarkan slug
     */
    public function show($slug)
    {
        // Cari data unit sekolah dari tabel 'school' berdasarkan sch_slug
        $school = DB::table('school')->where('sch_slug', $slug)->first();

        // Jika data unit sekolah tidak ditemukan, tampilkan 404
        if (!$school) {
            abort(404, 'Halaman unit sekolah tidak ditemukan.');
        }

        return view('sekolah', compact('school'));
    }
}
