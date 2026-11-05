<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceHour;

class HubungiKamiController extends Controller
{
    public function index()
    {
        // Ambil konfigurasi aplikasi dari database
        $config = DB::table('app_config')->first();
        $web = $config ? (array) $config : [];

        // Ambil data jam operasional dari tabel service_hour (bisa difilter sta = 1 jika aktif)
        $serviceHours = ServiceHour::where('sta', 1)->get();

        return view('hubungi-kami', [
            'title'        => 'Hubungi Kami',
            'web'          => $web,
            'serviceHours' => $serviceHours // <-- Kirim data jam operasional ke view
        ]);
    }

    /**
     * Memproses pengiriman pesan formulir kontak (AJAX Response)
     */
    public function send(Request $request)
    {
        // Validasi Input
        $request->validate([
            'form_name'    => 'required|string|max:255',
            'form_email'   => 'required|email|max:255',
            'form_subject' => 'required|string|max:255',
            'form_message' => 'required|string',
        ]);

        try {
            // Simpan pesan ke tabel consultation_set (jika ada)
            if (DB::getSchemaBuilder()->hasTable('consultation_set')) {
                DB::table('consultation_set')->insert([
                    'name'             => $request->form_name,
                    'email'            => $request->form_email,
                    'subject'          => $request->form_subject,
                    'phone'            => $request->form_phone,
                    'message'          => $request->form_message,
                    'datetime_created' => now(),
                ]);
            }

            // Response format JSON sesuai skrip AJAX di Blade
            return response()->json([
                'status'  => true,
                'message' => 'Pesan Anda berhasil dikirim!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal mengirim pesan: ' . $e->getMessage()
            ], 500);
        }
    }
}
