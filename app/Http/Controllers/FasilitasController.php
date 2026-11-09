<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\AppMenu;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        // Ambil seluruh data fasilitas beserta relasi detailnya
        $facilities = Facility::with('details')->orderBy('facility_id', 'asc')->get();

        // Ambil data menu app_menu untuk halaman fasilitas
        $menu = AppMenu::where('slug', 'fasilitas')->first();

        return view('fasilitas', compact('facilities', 'menu'));
    }
}
