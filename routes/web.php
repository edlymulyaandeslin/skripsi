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

// route authenticate
Route::prefix('auth')->group(function () {
    route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
    route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
    route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/', function () {
        return view('dashboard', [
            'title' => 'E - Skripsi'
        ]);
    });

    Route::resource('/judul', JudulController::class);

    Route::resource('/logbook', LogbookController::class);

    Route::resource('/sempro', SemproController::class);

    Route::resource('/nilai-sempro', NilaiSemproController::class)->except(['create', 'destroy']);

    Route::resource('/kompre', KompreController::class);

    Route::resource('/nilai-kompre', NilaiKompreController::class)->except(['create', 'destroy']);

    Route::get('/mahasiswa-bimbingan', [MahasiswaSkripsiController::class, 'bimbingan']);

    Route::get('/mahasiswa-uji-sempro', [MahasiswaSkripsiController::class, 'sempro']);

    Route::get('/mahasiswa-uji-kompre', [MahasiswaSkripsiController::class, 'kompre']);

    Route::get('/mahasiswa-skripsi/{user}', [MahasiswaSkripsiController::class, 'show']);

    Route::prefix('manajemen')->group(function () {
        // route update profile
        Route::get('/profile/{user}', [ProfileUpdate::class, 'index']);
        Route::get('/profile/{user}/edit', [ProfileUpdate::class, 'edit']);
        Route::patch('/profile/{user}', [ProfileUpdate::class, 'update']);
    });
});

// route manajemen users pada halaman admin
Route::middleware('admin')->prefix('manajemen')->group(function () {
    // route manajemen mahasiswa
    Route::resource('/mahasiswa', MahasiswaController::class);
    // route manajemen koordinator
    Route::resource('/koordinator', KoordinatorController::class);
    // route manajemen dosen
    Route::resource('/dosen', DosenController::class);
});

Route::middleware('mahasiswa')->group(function () {
    Route::resource('manajemen/dokumen', DokumenController::class)->names([
        'destroy' => 'dokumen.reset'
    ]);

    // cetak lembar bimbingan
    Route::get('cetak/bimbingan-proposal/download/pdf', [CetakController::class, 'cetak_bproposal']);
    Route::get('cetak/bimbingan-kompre/download/pdf', [CetakController::class, 'cetak_bkompre']);
});


Route::middleware('koordinator')->group(function () {
    // laporan
    Route::prefix('laporan')->group(function () {
        Route::get('/seminar', [LaporanController::class, 'seminar']);
        Route::get('/lulus-sempro', [LaporanController::class, 'lulusSempro']);
        Route::get('/lulus-kompre', [LaporanController::class, 'lulusKompre']);
        Route::get('/yudisium', [LaporanController::class, 'yudisium']);
        Route::get('/rekap-judul', [LaporanController::class, 'rekapJudul']);
    });

    // cetak laporan
    Route::prefix('cetak')->group(function () {
        Route::get('/berita-acara-sempro/{sempro}/download/pdf', [CetakController::class, 'cetak_bAcaraSempro']);
        Route::get('/berita-acara-kompre/{kompre}/download/pdf', [CetakController::class, 'cetak_bAcaraKompre']);
        Route::get('/list-mahasiswa-seminar', [CetakController::class, 'cetak_listMahasiswaSeminar']);
        Route::get('/lulus-sempro', [CetakController::class, 'cetak_lulusSempro']);
        Route::get('/lulus-kompre', [CetakController::class, 'cetak_lulusKompre']);
        Route::post('/yudisium', [CetakController::class, 'cetak_yudisium']);
        Route::get('/list-judul', [CetakController::class, 'cetak_listJudul']);
    });

    // setting bobot
    Route::resource('/bobot', BobotController::class)->only([
        'edit',
        'update'
    ]);

    // Administrasi
    Route::get('/adm-seminar/{id}/pay/{total}', [AdministrasiController::class, 'edit']);
    Route::get('/adm-seminar/create/{id}/{total}', [AdministrasiController::class, 'create']);
    Route::post('/adm-seminar/{id}/{total}', [AdministrasiController::class, 'store']);
    Route::delete('/adm-seminar/{id}', [AdministrasiController::class, 'destroy'])->name('administrasi.destroy');
});

Route::get('/adm-seminar', [AdministrasiController::class, 'index']);
