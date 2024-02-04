<?php

namespace App\Http\Controllers;

use App\Models\Kompre;
use App\Models\NilaiKompre;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiKompreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kompre.nilai.index', [
            'title' => 'E - Skripsi | Nilai Sempro',
            'kompres' => Kompre::with('judul', 'judul.mahasiswa', 'teampenguji', 'nilaikompre')->where('status', 'diterima')->latest()->get(),
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
            'kompre_id' => 'required',
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

        NilaiKompre::create($validateData);

        Alert::success('Success!', 'Value entered successfully');

        return redirect('/nilai/kompre');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nilaikompre = Kompre::with(['judul', 'judul.mahasiswa', 'teampenguji', 'nilaikompre'])->find($id);

        return response()->json($nilaikompre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('kompre.nilai.edit', [
            'title' => 'Input Nilai',
            'kompre' => Kompre::with('judul', 'nilaikompre')->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'kompre_id' => 'required',
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

        NilaiKompre::where('id', $id)->update($validateData);

        Alert::success('Success!', 'Value updated successfully');

        return redirect('/nilai/kompre');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiKompre $nilaiKompre)
    {
        //
    }
}
