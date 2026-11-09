<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobDetail;
use App\Models\JobSource;
use App\Models\AppMenu;
use Illuminate\Support\Facades\DB;

class RekrutmenController extends Controller
{
    /**
     * Menampilkan daftar lowongan pekerjaan aktif dan sumber informasi
     */
    public function index()
    {
        // Ambil lowongan dengan status aktif (status = 1) dan batas tanggal buka/tutup
        $jobs = Job::where('status', 1)
            ->where(function ($query) {$query->whereNull('datetime_close')
                      ->orWhere('datetime_close', '>=', now());
            })
            ->orderBy('datetime_open', 'desc')
            ->get();

        // Ambil daftar sumber informasi karir
        $sources = JobSource::all();

        // Ambil data menu app_menu untuk halaman rekrutmen
        $menu = AppMenu::where('slug', 'rekrutmen')->first();

        return view('rekrutmen', compact('jobs', 'sources', 'menu'));
    }

    /**
     * Memproses formulir lamaran pekerjaan
     */
    public function apply(Request $request)
    {
        $request->validate([
            'job_id'        => 'required|exists:job,job_id',
            'full_name'     => 'required|string|max:255',
            'jk'            => 'required|in:L,P',
            'email'         => 'required|email|max:255',
            'job_source_id' => 'required|exists:job_source,job_source_id',
            'cv_file'       => 'required|file|mimes:pdf,doc,docx|max:5120',
            'note'          => 'nullable|string',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv_file')) {
            $cvPath =$request->file('cv_file')->store('cv_applicants', 'public');
        }

        // Simpan ke tabel job_detail
        JobDetail::create([
            'job_id'        => $request->job_id,
            'full_name'     => $request->full_name,
            'jk'            => $request->jk,
            'email'         => $request->email,
            'job_source_id' => $request->job_source_id,
            'cv_file'       => $cvPath,
            'note'          => $request->note,
            'date_apply'    => now()->toDateString(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'status'  => true,
                'message' => 'Lamaran pekerjaan berhasil dikirim. Tim HRD kami akan meninjau berkas Anda.'
            ]);
        }

        return back()->with('success', 'Lamaran pekerjaan berhasil dikirim! Tim HRD kami akan meninjau berkas Anda.');
    }
}
