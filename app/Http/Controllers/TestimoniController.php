<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use App\Models\AppMenu;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Menampilkan daftar testimoni utama (Tabel testimony)
     */
    public function index()
    {
        // Ambil data testimoni dari tabel testimony
        $testimonies = Testimony::orderBy('testimony_id', 'desc')->paginate(6);
        $menu = AppMenu::where('slug', 'testimoni')->first();

        return view('testimoni', compact('testimonies', 'menu'));
    }

    /**
     * Menampilkan halaman detail testimoni beserta testimony_detail
     */
    public function show($slug)
    {
        // Cari data testimoni beserta rincian testimony_detail
        $testimony = Testimony::with('details')
            ->where('testimony_slug', $slug)
            ->firstOrFail();

        // Ambil testimoni lainnya untuk widget sidebar
        $otherTestimonies = Testimony::where('testimony_id', '!=', $testimony->testimony_id)
            ->orderBy('testimony_id', 'desc')
            ->take(5)
            ->get();

        return view('testimoni-detail', compact('testimony', 'otherTestimonies'));
    }
}
