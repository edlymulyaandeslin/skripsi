<?php

namespace App\Http\Controllers;

use App\Models\NilaiSempro;
use App\Models\Sempro;
use Illuminate\Http\Request;

class NilaiSemproController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sempro.nilai.index', [
            'title' => 'E - Skripsi | Nilai Sempro',
            'sempros' => Sempro::with('judul', 'judul.mahasiswa', 'teampenguji', 'nilaisempro')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiSempro $nilaiSempro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiSempro $nilaiSempro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NilaiSempro $nilaiSempro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiSempro $nilaiSempro)
    {
        //
    }
}
