<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\Kompre;
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

        // find data sempro berdasarkan id mahasiswa yg login dan statusnya != ditolak
        $sempro = Sempro::with(['judul'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->where('status', '!=', 'ditolak')
            ->get();

        // cek apakah sudah pernah mengajukan sempro atau tidak
        if ($sempro->count() !== 0) {
            return redirect('/sempro')->with('success', 'Anda hanya dapat mengajukan seminar  proposal 1x !!');
        }

        return view('sempro.create', [
            'title' => 'Sempro | Create',
            'juduls' => Judul::with('mahasiswa')->where('status', 'diterima')->where('mahasiswa_id', auth()->user()->id)->latest()->get()
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
        $sempro = Sempro::with(['judul', 'judul.mahasiswa', 'teampenguji'])->find($id);

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
        $judul = Judul::whereHas('sempro', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();

        Sempro::destroy($id);

        Kompre::where('judul_id', $judul->id)->delete();

        return redirect('/sempro')->with('success', 'Sempro has been deleted!');
    }
}
