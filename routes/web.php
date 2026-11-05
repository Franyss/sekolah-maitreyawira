<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubungiKamiController;
use App\Http\Controllers\PencapaianController;
use App\Http\Controllers\PendaftaranSiswaController;
use App\Http\Controllers\ProgramUnggulanController;
use App\Http\Controllers\RekrutmenController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

// --- HALAMAN UTAMA & PUBLIK ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/users', [UserController::class, 'index']);

// --- NAVIGASI PROFIL & INFORMASI PUBLIK ---
Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah.index');
Route::get('/visi-misi-motto', [VisiMisiController::class, 'index'])->name('visi-misi.index');
Route::get('/program-unggulan', [ProgramUnggulanController::class, 'index'])->name('program-unggulan.index');
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
Route::get('/pencapaian', [PencapaianController::class, 'index'])->name('pencapaian.index');

// Testimoni Routes
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
Route::get('/testimoni-orang-tua-siswa', [TestimoniController::class, 'index'])->name('testimoni.alt');

// Unit Sekolah Routes
Route::get('/sekolah/{slug}', [SekolahController::class, 'show'])->name('sekolah.show');

// Pendaftaran, Rekrutmen, Galeri, Berita
Route::get('/pendaftaran-siswa', [PendaftaranSiswaController::class, 'index'])->name('pendaftaran-siswa.index');
Route::get('/pendaftaran-siswa-form', [PendaftaranSiswaController::class, 'form'])->name('pendaftaran-siswa.form');
Route::get('/rekrutmen', [RekrutmenController::class, 'index'])->name('rekrutmen.index');
Route::post('/rekrutmen/apply', [RekrutmenController::class, 'apply'])->name('rekrutmen.apply');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');


Route::get('/form/{formType?}', function ($formType = 'hubungi-kami') {
    return view('form', compact('formType'));
})->name('form.show');

// Rute Submisi Form (POST)
Route::post('/form/submit/{formType}', [FormController::class, 'submit'])->name('form.submit');

// Hubungi Kami Routes (Form & AJAX Submit)
Route::get('/hubungi-kami', [HubungiKamiController::class, 'index'])->name('hubungi-kami.index');
Route::post('/hubungi-kami/send', [HubungiKamiController::class, 'send'])->name('hubungi-kami.send');

// --- AUTHENTICATION ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- DATABASE CRUD MANAGEMENT DASHBOARD (WAJIB LOGIN) ---
Route::middleware('auth')->group(function () {
    Route::get('/data/{tableName?}', [DataController::class, 'index'])->name('data.index');
    Route::get('/data/{tableName}/create', [DataController::class, 'create'])->name('data.create');
    Route::post('/data/{tableName}', [DataController::class, 'store'])->name('data.store');
    Route::get('/data/{tableName}/{id}/edit', [DataController::class, 'edit'])->name('data.edit');
    Route::put('/data/{tableName}/{id}', [DataController::class, 'update'])->name('data.update');
    Route::delete('/data/{tableName}/{id}', [DataController::class, 'destroy'])->name('data.destroy');
});
