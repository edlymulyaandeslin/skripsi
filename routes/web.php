<?php

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
});

Route::resource('/judul', JudulController::class);

Route::resource('/logbook', LogbookController::class);

Route::resource('/nilai/sempro', NilaiSemproController::class);

Route::resource('/sempro', SemproController::class);


Route::resource('/kompre', KompreController::class);

Route::resource('/nilai/kompre', NilaiKompreController::class);

// route manajemen users
Route::prefix('manajemen')->group(function () {
    // Route::resource('/mahasiswa', KompreController::class);
    // Route::resource('/koordinator', KompreController::class);
    // Route::resource('/dosen', KompreController::class);

    // route manajemen pembimbing dan penguji
    Route::resource('/teampenguji', TeamPengujiController::class);
});
