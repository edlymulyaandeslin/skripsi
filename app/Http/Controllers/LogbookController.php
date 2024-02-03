<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Http\Requests\StoreLogbookRequest;
use App\Http\Requests\UpdateLogbookRequest;
use App\Models\Judul;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('logbook.index', [
            'title' => 'E - Skripsi | Logbook',
            'logbooks' => Logbook::with(['judul', 'judul.mahasiswa'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logbook.create', [
            'title' => 'Logbook | Create',
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
            'deskripsi' => 'required'
        ]);

        Logbook::create($validateData);

        return redirect('/logbook')->with('success', 'Logbook has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $logbooks = Logbook::with(['judul', 'judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2'])->find($id);

        return response()->json($logbooks);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('logbook.edit', [
            'title' => 'Logbook | Edit',
            'logbook' => Logbook::find($id),
            'juduls' => Judul::where('status', 'diterima')->latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [];

        if ($request->filled('notes')) {
            $rules['notes'] = 'required';
        }
        if ($request->filled('status')) {
            $rules['status'] = 'required';
        }

        $validateData = $request->validate($rules);

        Logbook::where('id', $id)->update($validateData);

        return redirect('/logbook')->with('success', 'Logbook has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Logbook::destroy($id);

        return redirect('/logbook')->with('success', 'Logbook has been deleted!');
    }
}
