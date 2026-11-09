<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisiMisiController extends Controller
{
    public function index()
    {
        // Ambil data Visi, Misi, dan Motto dari tabel app_config
        $configs = DB::table('app_config')
            ->whereIn('conf_key', ['app_page_vision', 'app_page_mission', 'app_page_motto'])
            ->pluck('conf_value', 'conf_key');

        return view('visi-misi-motto', compact('configs'));
    }
}
