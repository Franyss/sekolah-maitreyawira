<?php

namespace App\Http\Controllers;

use App\Models\ConsultationSet;
use App\Models\ConsSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KonsultasiController extends Controller
{
    /**
     * Menampilkan formulir konsultasi siswa & sesi waktu yang tersedia
     */
    public function index()
    {
        // Ambil data jadwal konsultasi aktif (sta = 1)
        $schedules = ConsultationSet::where('sta', 1)
            ->orderBy('cons_tanggal', 'asc')
            ->orderBy('cons_jam', 'asc')
            ->get();

        return view('konsultasi', compact('schedules'));
    }

    /**
     * Menyimpan data pengajuan konsultasi siswa ke tabel cons_schedule
     */
    public function store(Request $request)
    {
        $request->validate([
            'cons_id'          => 'required|exists:consultation_set,cons_id',
            'nama_siswa_scd'   => 'required|string|max:200',
            'nama_ortu_scd'    => 'required|string|max:200',
            'asal_sekolah_scd' => 'required|string',
            'no_wa_ortu_scd'   => 'required|string|max:14',
            'email_scd'        => 'required|email|max:100',
        ], [
            'cons_id.required'          => 'Silakan pilih sesi waktu konsultasi yang tersedia.',
            'cons_id.exists'            => 'Sesi konsultasi yang dipilih tidak valid.',
            'nama_siswa_scd.required'   => 'Nama siswa wajib diisi.',
            'nama_siswa_scd.max'        => 'Nama siswa maksimal 200 karakter.',
            'nama_ortu_scd.required'    => 'Nama orang tua / wali wajib diisi.',
            'nama_ortu_scd.max'         => 'Nama orang tua maksimal 200 karakter.',
            'asal_sekolah_scd.required' => 'Kelas / unit sekolah siswa wajib diisi.',
            'no_wa_ortu_scd.required'   => 'Nomor WhatsApp orang tua/wali wajib diisi.',
            'no_wa_ortu_scd.max'        => 'Nomor WhatsApp maksimal 14 karakter.',
            'email_scd.required'        => 'Alamat email wajib diisi.',
            'email_scd.email'           => 'Format alamat email tidak valid.',
            'email_scd.max'             => 'Alamat email maksimal 100 karakter.',
        ]);

        ConsSchedule::create([
            'cons_id'          => $request->cons_id,
            'nama_siswa_scd'   => $request->nama_siswa_scd,
            'nama_ortu_scd'    => $request->nama_ortu_scd,
            'asal_sekolah_scd' => $request->asal_sekolah_scd,
            'no_wa_ortu_scd'   => $request->no_wa_ortu_scd,
            'email_scd'        => $request->email_scd,
            'sta'              => 1,
            'datetime_apply'   => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Pengajuan konsultasi siswa berhasil dikirim! Pihak sekolah akan mengonfirmasi kehadiran Anda melalui WhatsApp.');
    }
}
