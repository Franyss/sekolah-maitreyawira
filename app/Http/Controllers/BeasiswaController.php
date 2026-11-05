<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship;

class BeasiswaController extends Controller
{
    public function index()
    {
        return view('pendaftaran-beasiswa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenjang'        => 'required|string|max:50',
            'nama_siswa'     => 'required|string|max:200',
            'tempat_lahir'   => 'required|string|max:150',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
            'no_hp_wa'       => 'nullable|string|max:20',
            'email'          => 'required|email|max:50',
            'nama_ayah'      => 'nullable|string|max:200',
            'nama_ibu'       => 'nullable|string|max:200',
            'no_wa'          => 'nullable|string|max:20',
            'asal_sekolah'   => 'nullable|string|max:200',
            'desk_pres'      => 'nullable|string',
            'schs_id'        => 'nullable|integer',
            'up_doc_bea'     => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'gallery'        => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Upload Berkas Dokumen
        $docPath = null;
        if ($request->hasFile('up_doc_bea')) {
            $docPath = $request->file('up_doc_bea')->store('scholarship_docs', 'public');
        }

        // Upload Galeri Foto
        $galleryPath = null;
        if ($request->hasFile('gallery')) {
            $galleryPath = $request->file('gallery')->store('scholarship_gallery', 'public');
        }

        // Simpan ke database dengan nama kolom yang sesuai di DB
        Scholarship::create([
            'jenjang'        => $request->jenjang,
            'nama_siswa'     => $request->nama_siswa,
            'tempat_lhr'     => $request->tempat_lahir,
            'tanggal_lhr'    => $request->tanggal_lahir,
            'alamat'         => $request->alamat,
            'no_hp_wa'       => $request->no_hp_wa,
            'email'          => $request->email,
            'nama_ayah'      => $request->nama_ayah,
            'nama_ibu'       => $request->nama_ibu,
            'no_wa'          => $request->no_wa,
            'asal_sekolah'   => $request->asal_sekolah,
            'desk_pres'      => $request->desk_pres,
            'up_doc_bea'     => $docPath,
            'schs_id'        => $request->schs_id ?? 1,
            'gallery'        => $galleryPath,
            'datetime_apply' => now(),
        ]);

        return back()->with('success', 'Pendaftaran beasiswa berhasil dikirim!');
    }
}
