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
            'sempros' => Sempro::with('judul', 'judul.mahasiswa', 'teampenguji', 'nilaisempro')->where('status', 'diterima')->latest()->get(),
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
        $rules = [
            'sempro_id' => 'required',
        ];
        if ($request->filled('nilai1')) {
            $rules['nilai1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2')) {
            $rules['nilai2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3')) {
            $rules['nilai3'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4')) {
            $rules['nilai4'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5')) {
            $rules['nilai5'] = 'required|numeric|min:0|max:25';
        }

        $validateData = $request->validate($rules);

        NilaiSempro::create($validateData);

        return redirect('/nilai/sempro')->with('success', 'Nilai sempro berhasil diinputkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nilaiSempro = Sempro::with(['judul', 'judul.mahasiswa', 'teampenguji', 'nilaisempro'])->find($id);

        return response()->json($nilaiSempro);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('sempro.nilai.edit', [
            'title' => 'Input Nilai',
            'sempro' => Sempro::with('judul', 'nilaisempro')->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'sempro_id' => 'required',
        ];
        if ($request->filled('nilai1')) {
            $rules['nilai1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2')) {
            $rules['nilai2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3')) {
            $rules['nilai3'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4')) {
            $rules['nilai4'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5')) {
            $rules['nilai5'] = 'required|numeric|min:0|max:25';
        }

        $validateData = $request->validate($rules);

        NilaiSempro::where('id', $id)->update($validateData);

        return redirect('/nilai/sempro')->with('success', 'Nilai sempro berhasil diinputkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiSempro $nilaiSempro)
    {
        //
    }
}
