<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.index', [
            'title' => 'E - Skripsi | Mahasiswa'
        ]);
    }
}
