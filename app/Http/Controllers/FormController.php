<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

class FormController extends Controller
{
    /**
     * Pemetaan jenis formulir publik ke tabel tujuan database
     */
    protected $formTableMap = [
        'hubungi-kami' => 'consultation_set',
        'pendaftaran'  => 'student_reg',
        'rekrutmen'    => 'job_source',
    ];

    /**
     * Memproses submisi formulir publik secara dinamis (AJAX & Standard Form)
     */
    public function submit(Request $request, $formType)
    {
        // 1. Validasi jenis formulir
        if (!array_key_exists($formType, $this->formTableMap)) {
            return $this->buildResponse($request, false, 'Jenis formulir tidak dikenali atau tidak valid.', 400);
        }

        $tableName = $this->formTableMap[$formType];

        // 2. Pastikan tabel tersedia di database
        if (!Schema::hasTable($tableName)) {
            return $this->buildResponse($request, false, "Tabel penampung '{$tableName}' tidak ditemukan.", 404);
        }

        // 3. Filter input sesuai kolom yang ada di tabel
        $columns = Schema::getColumnListing($tableName);
        $data = $request->only($columns);

        // 4. Proses pengunggahan berkas/lampiran jika ada
        foreach ($request->allFiles() as $key => $file) {
            if (in_array($key, $columns) && $request->hasFile($key)) {
                $data[$key] = $file->store("uploads/{$tableName}", 'public');
            }
        }

        // 5. Penanganan otomatis timestamp
        $now = now();
        if (in_array('created_at', $columns)) {
            $data['created_at'] = $now;
        }
        if (in_array('datetime_created', $columns)) {
            $data['datetime_created'] = $now;
        }

        // 6. Simpan data ke database
        try {
            DB::table($tableName)->insert($data);

            return $this->buildResponse($request, true, 'Formulir berhasil dikirim! Terima kasih.');

        } catch (QueryException $e) {
            return $this->buildResponse($request, false, 'Gagal menyimpan formulir: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Helper untuk mengembalikan respons berformat JSON (jika AJAX) atau Redirect
     */
    protected function buildResponse(Request $request, bool $status, string $message, int $statusCode = 200)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status'  => $status,
                'message' => $message
            ], $statusCode);
        }

        if ($status) {
            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->withInput()->with('error', $message);
    }
}
