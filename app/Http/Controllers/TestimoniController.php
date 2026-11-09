<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use App\Models\AppMenu;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        // Ambil data testimoni dari database
        $testimonies = Testimony::orderBy('testimony_id', 'desc')->get();

        // Ambil data menu app_menu untuk halaman testimoni
        $menu = AppMenu::where('slug', 'testimoni')->first();

        return view('testimoni', compact('testimonies', 'menu'));
    }
}
