<?php

namespace App\Http\Controllers;

use App\Models\Kompre;
use App\Models\Sempro;
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function sempro()
    {
        $sempros = Sempro::with(['judul.mahasiswa'])->whereNotIn('status', ['diajukan', 'perbaikan'])->latest()->paginate(10);

        return view('berita-acara.sempro', [
            'title' => 'Berita Acara Seminar Proposal',
            'sempros' => $sempros
        ]);
    }
    public function kompre()
    {
        $kompres = Kompre::with(['judul.mahasiswa'])->whereNotIn('status', ['diajukan', 'perbaikan'])->latest()->paginate(10);

        return view('berita-acara.kompre', [
            'title' => 'Berita Acara Seminar Komprehensif',
            'kompres' => $kompres
        ]);
    }
}
