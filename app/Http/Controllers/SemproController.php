<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\Kompre;
use App\Models\Sempro;
use App\Models\TeamPenguji;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SemproController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // confirm delete judul
        $title = 'Delete Seminar Proposal!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('sempro.index', [
            'title' => 'E - Skripsi | Sempro',
            'sempros' => Sempro::with(['judul', 'judul.mahasiswa'])->latest()->get()
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
            ->where('status', '!=', 'tidak lulus')
            ->get();

        // find judul berdasarkan logbook dengan status acc proposal
        $juduls = Judul::withCount(['logbook as acc_proposal_count' => function ($query) {
            $query->where('status', 'acc proposal')->where('kategori', 'proposal');
        }])->with(['mahasiswa', 'mahasiswa.dokumen', 'logbook'])->whereHas('logbook', function ($query) {
            $query->where('status', 'acc proposal');
        })->where('mahasiswa_id', auth()->user()->id)
            ->having('acc_proposal_count', '>=', 2)
            ->latest()
            ->get();

        $dokumen = auth()->user()->dokumen;

        return view('sempro.create', [
            'title' => 'Sempro | Create',
            'juduls' => $juduls,
            'sempro' => $sempro,
            'dokumen' => $dokumen
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul_id' => 'required',
            'pembayaran' => 'required|file|mimes:pdf|max:2048',
        ]);

        $pembayaran = 'document_' . str()->random(10) . '.' . $request->file('pembayaran')->extension();
        $validateData['pembayaran'] = $request->file('pembayaran')->storeAs('post-pembayaran', $pembayaran);

        Sempro::where('status', 'tidak lulus')->get()->each(function ($sempro) {
            Storage::delete($sempro->pembayaran);
            $sempro->delete();
        });

        Sempro::create($validateData);

        Alert::success('success!', 'Sempro has been added');

        return redirect('/sempro');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sempro = Sempro::with(['judul', 'judul.mahasiswa.dokumen', 'penguji1', 'penguji2', 'penguji3'])->find($id);

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
            'dosens' => User::where('role_id', 3)->latest()->get()
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

        if ($request->filled('penguji1_id') || $request->filled('penguji2_id') || $request->filled('penguji3_id')) {
            $rules['penguji1_id'] = 'required';
            $rules['penguji2_id'] = 'required';
            $rules['penguji3_id'] = 'required';
        }

        if ($request->input('status')) {
            $rules['status'] = 'required';
        }

        if ($request->filled('notes')) {
            $rules['notes'] = 'required';
        }

        if ($request->file('pembayaran')) {
            $rules['pembayaran'] = 'required|file|mimes:pdf|max:2048';
        }

        $validateData = $request->validate($rules);

        if ($request->file('pembayaran')) {
            if ($request->oldPembayaran) {
                Storage::delete($request->oldPembayaran);
            }

            $pembayaran = 'document_' . str()->random(10) . '.' . $request->file('pembayaran')->extension();
            $validateData['pembayaran'] = $request->file('pembayaran')->storeAs('post-pembayaran', $pembayaran);
        }

        Sempro::where('id', $id)->update($validateData);

        Alert::success('success!', 'Sempro has been updated');

        return redirect('/sempro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $judul = Judul::whereHas('sempro', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();

        $sempro = Sempro::find($id);

        if ($sempro->pembayaran) {
            Storage::delete($sempro->pembayaran);
        }

        $sempro->destroy($id);

        Kompre::where('judul_id', $judul->id)->delete();

        Alert::success('success!', 'Sempro has been deleted');

        return redirect('/sempro');
    }
}
