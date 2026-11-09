<?php

namespace App\Http\Controllers;

use App\Models\AppSlider;
use App\Models\Post;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Data Slider Banner
        $sliders = AppSlider::whereIn('status', [1, '1', 'Publish', 'published'])
            ->orderBy('id', 'asc')
            ->get();

        // 2. Ambil Data Konfigurasi Logo, Video Tour, Judul & Deskripsi
        $configs = DB::table('app_config')
            ->whereIn('conf_key', [
                'app_logo_tk',
                'app_logo_sd',
                'app_logo_smp',
                'app_logo_sma',
                'app_content_sch_tk',
                'app_content_sch_sd',
                'app_content_sch_smp',
                'app_content_sch_sma',
                'app_content_video_tour_title1',
                'app_set_title_sch',
                'app_content_url_video_tour'
            ])
            ->pluck('conf_value', 'conf_key');

        // 3. Ambil 4 Data Berita Terkini (Post Murni)
        $latestNews = Post::with(['author', 'tags'])
            ->whereIn('status', ['Publish', 'published'])
            ->latest('datetime_created')
            ->take(4)
            ->get();

        // 4. Ambil 2 Data Prestasi Terkini (Achievement)
        $latestAchievements = Achievement::latest('datetime_created')
            ->take(2)
            ->get();

        return view('home', compact('sliders', 'configs', 'latestNews', 'latestAchievements'));
    }
}
