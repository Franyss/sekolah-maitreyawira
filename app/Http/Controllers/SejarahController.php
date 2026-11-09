<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use App\Models\AppMenu;

class SejarahController extends Controller
{
    public function index()
    {
        // Ambil data Sejarah beserta relasi detailnya
        $histories = Sejarah::with('details')->orderBy('history_date', 'asc')->get();

        // Ambil data menu app_menu untuk halaman sejarah
        $menu = AppMenu::where('slug', 'sejarah')->first();

        return view('sejarah', compact('histories', 'menu'));
    }
}
