<?php

use App\Http\Controllers\JudulController;
use App\Http\Controllers\KompreController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\SemproController;
use App\Http\Controllers\TeamPembimbingController;
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
    return view('dashboard');
});

Route::resource('/judul', JudulController::class);

Route::resource('/logbook', LogbookController::class);

Route::resource('/sempro', SemproController::class);

Route::resource('/kompre', KompreController::class);

// route manajemen users
// Route::resource('/mahasiswa', KompreController::class);
// Route::resource('/koordinator', KompreController::class);
// Route::resource('/dosen', KompreController::class);

// route manajemen pembimbing dan penguji
Route::resource('/teampembimbing', TeamPembimbingController::class);
Route::resource('/teampenguji', TeamPengujiController::class);
