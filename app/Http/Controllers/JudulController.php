<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JudulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('judul.index', [
            'title' => 'E - Skripsi | Judul',
            'listjudul' => Judul::with(['mahasiswa', 'pembimbing1', 'pembimbing2'])->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('judul.create', [
            'title' => 'Judul | Create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required',
            'latar_belakang' => 'required'
        ]);

        $validateData['mahasiswa_id'] = auth()->user()->id;

        Judul::create($validateData);

        return redirect('/judul')->with('success', 'Judul has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $judul = Judul::with(['mahasiswa', 'pembimbing1', 'pembimbing2', 'logbook'])->find($id);

        return response()->json($judul);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('judul.edit', [
            'title' => 'Judul | Edit',
            'judul' => Judul::with(['mahasiswa',  'pembimbing1', 'pembimbing2'])->find($id),
            'dosens' => User::where('role_id', 3)->get(),
            'alljudul' => Judul::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'pembimbing1_id' => 'required',
            'pembimbing2_id' => 'required',
            'status' => 'required'
        ];

        $validateData = $request->validate($rules);

        Judul::where('id', $id)->update($validateData);

        return redirect('/judul')->with('success', 'Judul has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Judul::destroy($id);

        return redirect('/judul')->with('success', 'Judul has been deleted');
    }
}
