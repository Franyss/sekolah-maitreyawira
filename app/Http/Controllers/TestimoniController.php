<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        // Ambil data testimoni dari database
        $testimonies = Testimony::orderBy('testimony_id', 'desc')->get();

        // Tetap menggunakan view 'testimoni.blade.php'
        return view('testimoni', compact('testimonies'));
    }
}
