<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JudulController;
use App\Http\Controllers\KompreController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\NilaiKompreController;
use App\Http\Controllers\NilaiSemproController;
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
    'store' => 'nilai.sempro.store',
    'update' => 'nilai.sempro.update',
])->middleware('auth');


Route::resource('/kompre', KompreController::class)->middleware('auth');

Route::resource('/nilai/kompre', NilaiKompreController::class)->middleware('auth');

// route manajemen users
Route::prefix('manajemen')->group(function () {
    // Route::resource('/mahasiswa', KompreController::class);
    // Route::resource('/koordinator', KompreController::class);
    // Route::resource('/dosen', KompreController::class);

    // route manajemen pembimbing dan penguji
    Route::resource('/teampenguji', TeamPengujiController::class);
});

// route authenticate
Route::prefix('auth')->group(function () {
    route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
    route::post('/login', [AuthController::class, 'authenticate']);

    route::post('/logout', [AuthController::class, 'logout']);
});
