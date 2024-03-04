<?php

use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JudulController;
use App\Http\Controllers\KompreController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaSkripsiController;
use App\Http\Controllers\NilaiKompreController;
use App\Http\Controllers\NilaiSemproController;
use App\Http\Controllers\ProfileUpdate;
use App\Http\Controllers\SemproController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// dashboard
Route::get('/', function () {
    return view('dashboard', [
        'title' => 'E - Skripsi'
    ]);
})->middleware('auth');

// fitur judul
Route::resource('/judul', JudulController::class)->middleware('auth');

// fitur logbook
Route::resource('/logbook', LogbookController::class)->middleware('auth');

// fitur sempro dan penilaian
Route::resource('/sempro', SemproController::class)->middleware('auth');
Route::resource('/nilai/sempro', NilaiSemproController::class)->names([
    'show' => 'nilai.sempro.show',
    'store' => 'nilai.sempro.store',
    'update' => 'nilai.sempro.update',
])->except(['create', 'destroy'])->middleware('auth');

// fitur kompre dan penilaian
Route::resource('/kompre', KompreController::class)->middleware('auth');
Route::resource('/nilai/kompre', NilaiKompreController::class)->names([
    'show' => 'nilai.kompre.show',
    'store' => 'nilai.kompre.store',
    'update' => 'nilai.kompre.update',
])->except(['create', 'destroy']);

// fitur mahasiswa pada halaman dosen
Route::get('/mahasiswa-bimbingan', [MahasiswaSkripsiController::class, 'bimbingan'])->middleware('auth');
Route::get('/mahasiswa-uji-sempro', [MahasiswaSkripsiController::class, 'sempro'])->middleware('auth');
Route::get('/mahasiswa-uji-kompre', [MahasiswaSkripsiController::class, 'kompre'])->middleware('auth');
Route::get('/mahasiswa-skripsi/{user}', [MahasiswaSkripsiController::class, 'show'])->middleware('auth');

// route manajemen users pada halaman admin
Route::middleware('auth')->prefix('manajemen')->group(function () {
    // route manajemen mahasiswa
    Route::resource('/mahasiswa', MahasiswaController::class)->middleware('admin');

    // route manajemen koordinator
    Route::resource('/koordinator', KoordinatorController::class)->middleware('admin');

    // route manajemen dosen
    Route::resource('/dosen', DosenController::class)->middleware('admin');

    // route profile update
    Route::get('/profile/{user}', [ProfileUpdate::class, 'index']);
    Route::get('/profile/{user}/edit', [ProfileUpdate::class, 'edit']);
    Route::patch('/profile/{user}', [ProfileUpdate::class, 'update']);

    Route::resource('/dokumen', DokumenController::class)->names([
        'destroy' => 'dokumen.reset'
    ])->middleware('mahasiswa');
});


// route authenticate
Route::prefix('auth')->group(function () {
    // route login
    route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
    route::post('/login', [AuthController::class, 'authenticate']);

    // route logout
    route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
});

Route::middleware('koordinator')->prefix('laporan')->group(function () {
    Route::get('/seminar', [LaporanController::class, 'seminar']);
    Route::get('/lulus-sempro', [LaporanController::class, 'lulusSempro']);
    Route::get('/lulus-kompre', [LaporanController::class, 'lulusKompre']);
    Route::get('/yudisium', [LaporanController::class, 'yudisium']);
});

Route::prefix('cetak')->group(function () {
    // cetak lembar bimbingan
    Route::get('/bimbingan-proposal/download/pdf', [CetakController::class, 'cetak_bproposal'])->middleware('mahasiswa');
    Route::get('/bimbingan-kompre/download/pdf', [CetakController::class, 'cetak_bkompre'])->middleware('mahasiswa');

    // BERITA ACARA SEMPRO
    Route::get('/berita-acara-sempro/{sempro}/download/pdf', [CetakController::class, 'cetak_bAcaraSempro'])->middleware('koordinator');

    // BERITA ACARA KOMPRE
    Route::get('/berita-acara-kompre/{kompre}/download/pdf', [CetakController::class, 'cetak_bAcaraKompre'])->middleware('koordinator');

    // Cetak List Mahasiswa seminar
    Route::get('/list-mahasiswa-seminar', [CetakController::class, 'cetak_listMahasiswaSeminar'])->middleware('koordinator');

    // Cetak List mahasiswa lulus sempro
    Route::get('/lulus-sempro', [CetakController::class, 'cetak_lulusSempro'])->middleware('koordinator');
    Route::get('/lulus-kompre', [CetakController::class, 'cetak_lulusKompre'])->middleware('koordinator');

    // Cetak List mahasiswa lulus yudisium
    Route::post('/yudisium', [CetakController::class, 'cetak_yudisium'])->middleware('koordinator');
});

// setting bobot
Route::resource('/bobot', BobotController::class)->only([
    'edit',
    'update'
])->middleware('koordinator');

// Administrasi
Route::get('/adm-seminar', [AdministrasiController::class, 'index']);
Route::get('/adm-seminar/{id}/pay/{total}', [AdministrasiController::class, 'edit'])->middleware('koordinator');
Route::get('/adm-seminar/create/{id}/{total}', [AdministrasiController::class, 'create'])->middleware('koordinator');
Route::post('/adm-seminar/{id}/{total}', [AdministrasiController::class, 'store'])->middleware('koordinator');
Route::delete('/adm-seminar/{id}', [AdministrasiController::class, 'destroy'])->name('administrasi.destroy')->middleware('koordinator');
