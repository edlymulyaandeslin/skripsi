<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\Sempro;
use App\Models\TeamPenguji;
use App\Models\User;
use Illuminate\Http\Request;

class SemproController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sempro.index', [
            'title' => 'E - Skripsi | Sempro',
            'sempros' => Sempro::with(['judul', 'judul.mahasiswa', 'teampenguji'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sempro.create', [
            'title' => 'Sempro | Create',
            'juduls' => Judul::with('mahasiswa')->where('status', 'diterima')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul_id' => 'required',
        ]);

        Sempro::create($validateData);

        return redirect('/sempro')->with('success', 'Sempro has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sempro = Sempro::with('judul', 'judul.mahasiswa', 'teampenguji')->find($id);

        return response()->json($sempro);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('sempro.edit', [
            'title' => 'Sempro | Edit',
            'sempro' => Sempro::with('judul')->find($id),
            'teampenguji' => TeamPenguji::latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [];

        if ($request->input('tanggal_seminar')) {
            $rules['tanggal_seminar'] = 'required|date';
        }

        if ($request->input('jam')) {
            $rules['jam'] = 'required';
        }

        if ($request->input('ruang')) {
            $rules['ruang'] = 'required';
        }

        if ($request->input('team_penguji_id')) {
            $rules['team_penguji_id'] = 'required';
        }

        if ($request->input('status')) {
            $rules['status'] = 'required';
        }

        $validateData = $request->validate($rules);

        Sempro::where('id', $id)->update($validateData);

        return redirect('/sempro')->with('success', 'Sempro has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Sempro::destroy($id);

        return redirect('/sempro')->with('success', 'Sempro has been deleted!');
    }
}
