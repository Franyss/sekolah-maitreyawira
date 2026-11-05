<?php

namespace App\Http\Controllers;

use App\Models\AppSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = AppSlider::whereIn('status', [1, '1', 'Publish', 'published'])
            ->orderBy('id', 'asc')
            ->get();

        return view('home', compact('sliders'));
    }
}
