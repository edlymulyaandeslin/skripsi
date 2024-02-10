<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JudulController;
use App\Http\Controllers\KompreController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiKompreController;
use App\Http\Controllers\NilaiSemproController;
use App\Http\Controllers\ProfileUpdate;
use App\Http\Controllers\SemproController;
use App\Http\Controllers\TeamPengujiController;
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

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'E - Skripsi'
    ]);
})->middleware('auth');

Route::resource('/judul', JudulController::class)->middleware('auth');

Route::resource('/logbook', LogbookController::class)->middleware('auth');

Route::resource('/sempro', SemproController::class)->middleware('auth');
Route::resource('/nilai/sempro', NilaiSemproController::class)->names([
    'show' => 'nilai.sempro.show',
    'store' => 'nilai.sempro.store',
    'update' => 'nilai.sempro.update',
])->except(['create', 'destroy'])->middleware('auth');


Route::resource('/kompre', KompreController::class)->middleware('auth');
Route::resource('/nilai/kompre', NilaiKompreController::class)->names([
    'show' => 'nilai.kompre.show',
    'store' => 'nilai.kompre.store',
    'update' => 'nilai.kompre.update',
])->except(['create', 'destroy'])->middleware('auth');

// route manajemen users
Route::middleware('auth')->prefix('manajemen')->group(function () {
    // route manajemen mahasiswa
    Route::resource('/mahasiswa', MahasiswaController::class);

    // route manajemen koordinator
    Route::resource('/koordinator', KoordinatorController::class);

    // route manajemen dosen
    Route::resource('/dosen', DosenController::class);

    // route profile update
    Route::get('/profile/{user}', [ProfileUpdate::class, 'index'])->middleware('auth');
    Route::get('/profile/{user}/edit', [ProfileUpdate::class, 'edit'])->middleware('auth');
    Route::patch('/profile/{user}', [ProfileUpdate::class, 'update'])->middleware('auth');

    Route::resource('/dokumen', DokumenController::class)->names([
        'destroy' => 'dokumen.reset'
    ])->middleware('auth');
});

// route authenticate
Route::prefix('auth')->group(function () {
    // route login
    route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
    route::post('/login', [AuthController::class, 'authenticate']);

    // route logout
    route::post('/logout', [AuthController::class, 'logout']);
});
