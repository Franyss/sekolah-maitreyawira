<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\AppMenu;
use Illuminate\Http\Request;

class PencapaianController extends Controller
{
    public function index()
    {
        // Ambil data pencapaian / prestasi dengan paginasi
        $achievements = Achievement::with('details')
            ->latest('datetime_created')
            ->paginate(9);

        $menu = AppMenu::where('slug', 'pencapaian')->first();

        return view('pencapaian', compact('achievements', 'menu'));
    }

    public function show($slug)
    {
        // 1. Cari prestasi berdasarkan slug atau ID
        $achievement = Achievement::with('details')
            ->where('achievement_slug', $slug)
            ->orWhere('achievement_id', $slug)
            ->firstOrFail();

        // 2. Ambil seluruh record detail dari achievement_detail
        $details = $achievement->details;

        // 3. Ambil prestasi lainnya untuk sidebar
        $otherAchievements = Achievement::where('achievement_id', '!=', $achievement->achievement_id)
            ->latest('datetime_created')
            ->take(5)
            ->get();

        return view('pencapaian-detail', compact('achievement', 'details', 'otherAchievements'));
    }
}
