<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade; // <-- TAMBAHKAN FACADE BLADE

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // DAFTARKAN FOLDER views/partials SEBAGAI LOKASI BLADE COMPONENT
        Blade::anonymousComponentPath(resource_path('views/partials'));

        // Kirim data menu yang sudah terformat ke partial view navbar
        View::composer('partials.navbar', function ($view) {
            try {
                if (Schema::hasTable('app_menu')) {
                    $allMenus = DB::table('app_menu')
                        ->where('status', '1') // Mengambil hanya menu yang aktif (status = 1)
                        ->orderBy('menu_id', 'asc')
                        ->get()
                        ->map(function ($menu) {
                            // Jika 'link' NULL/kosong, gunakan nilai dari 'slug'
                            if (!empty($menu->link)) {
                                $menu->url = $menu->link;
                            } else {
                                $slug = ltrim($menu->slug ?? '', '/');
                                $menu->url = empty($slug) ? '/' : '/' . $slug;
                            }
                            return $menu;
                        });

                    // Pisahkan Menu Utama (parent_id = 0) & Submenu
                    $mainMenus = $allMenus->filter(fn($m) => empty($m->parent_id) || $m->parent_id == 0);
                    $subMenus = $allMenus->filter(fn($m) => !empty($m->parent_id) && $m->parent_id > 0)
                                         ->groupBy('parent_id');

                    $view->with(compact('mainMenus', 'subMenus'));
                    return;
                }
            } catch (\Exception $e) {
                // Ignore fallback
            }

            $view->with([
                'mainMenus' => collect(),
                'subMenus' => collect(),
            ]);
        });
    }
}
