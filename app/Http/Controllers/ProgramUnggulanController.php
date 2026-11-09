<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramDetail;
use App\Models\AppMenu;
use Illuminate\Http\Request;

class ProgramUnggulanController extends Controller
{
    public function index()
    {
        // 1. Ambil seluruh data program beserta semua detailnya (relasi hasMany 'details')
        $programs = Program::with('details')->orderBy('program_id', 'asc')->get();

        // 2. Ambil data menu app_menu untuk hero banner
        $menu = AppMenu::where('slug', 'program-unggulan')->first();

        return view('program-unggulan', compact('programs', 'menu'));
    }

    public function show($slug)
    {
        // 1. Cari data program utama berdasarkan slug atau ID beserta semua relasi details
        $program = Program::with('details')
            ->where('program_slug', $slug)
            ->orWhere('program_id', $slug)
            ->first();

        abort_unless($program, 404);

        // 2. Ambil seluruh daftar detail relasi dari tabel program_detail
        $details = $program->details;

        // 3. Ambil daftar program lain untuk navigasi sidebar
        $otherPrograms = Program::where('program_id', '!=', $program->program_id)
            ->orderBy('program_id', 'asc')
            ->get();

        return view('program-detail', compact('program', 'details', 'otherPrograms'));
    }
}
