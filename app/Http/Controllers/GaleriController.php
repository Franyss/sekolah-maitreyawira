<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\AppMenu;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->get('q'));
        $type   =$request->get('type');

        $query = Gallery::query();

        // Filter kata kunci pencarian pada judul & deskripsi
        if (!empty($search)) {$query->where(function ($q) use ($search) {
                $q->where('title', 'like', "\%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter tipe media (image / video-embed)
        if (!empty($type)) {
            $query->where('type',$type);
        }

        // Paginasi 12 item per halaman
        $galleries =$query->latest('datetime_created')->paginate(12)->withQueryString();

        // Ambil data menu app_menu untuk halaman galeri
        $menu = AppMenu::where('slug', 'galeri')->first();

        return view('galeri', compact('galleries', 'search', 'type', 'menu'));
    }
}
