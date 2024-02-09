<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // confirm delete judul
        $title = 'Delete Logbook!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

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
            'target_bimbingan' => 'required',
            'file_proposal' => 'required|file|mimes:pdf|max:5000',
            'kategori' => 'required'
        ]);

        $originalName = mt_rand(1, 99999) . '_' . $request->file('file_proposal')->getClientOriginalName();
        $validateData['file_proposal'] = $request->file('file_proposal')->storeAs('logbook', $originalName);

        Logbook::create($validateData);

        Alert::success('success!', 'Logbook has been added');

        return redirect('/logbook');
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
        $rules = [
            'status' => 'required',
        ];

        if ($request->filled('hasil')) {
            $rules['hasil'] = 'required';
        }

        $validateData = $request->validate($rules);

        Logbook::where('id', $id)->update($validateData);

        Alert::success('success!', 'Logbook has been updated');

        return redirect('/logbook');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $logbook = Logbook::find($id);

        if ($logbook->file_proposal) {
            Storage::delete($logbook->file_proposal);
        }

        $logbook->destroy($id);

        Alert::success('success!', 'Logbook has been deleted');

        return redirect('/logbook');
    }
}
