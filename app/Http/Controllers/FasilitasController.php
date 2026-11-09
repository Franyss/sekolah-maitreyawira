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

    /**
     * Menampilkan detail fasilitas berdasarkan facility_id
     */
    public function show($id)
    {
        // Ambil data fasilitas beserta rincian detail dari tabel facility_detail
        $facility = Facility::with('details')->findOrFail($id);

        // Ambil fasilitas lainnya untuk disajikan di sidebar
        $otherFacilities = Facility::where('facility_id', '!=',$id)
            ->orderBy('facility_id', 'asc')
            ->take(5)
            ->get();

        return view('fasilitas-detail', compact('facility', 'otherFacilities'));
    }
}
