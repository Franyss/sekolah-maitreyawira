<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        // Ambil seluruh data fasilitas beserta relasi detailnya
        $facilities = Facility::with('details')->orderBy('facility_id', 'asc')->get();

        return view('fasilitas', compact('facilities'));
    }
}
