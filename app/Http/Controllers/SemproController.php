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

        if (auth()->user()->role_id === 1 || auth()->user()->role_id === 2) {
            $sempros = Sempro::with(['judul', 'judul.mahasiswa'])->latest()->get();
            return view('sempro.index', [
                'title' => 'E - Skripsi | Sempro',
                'sempros' => $sempros,
            ]);
        }

        if (auth()->user()->role_id === 3) {
            $sempros = Sempro::with(['judul', 'judul.mahasiswa'])
                ->whereHas('judul', function ($query) {
                    $query->where('pembimbing1_id', auth()->user()->id)
                        ->orWhere('pembimbing2_id', auth()->user()->id);
                })
                ->orWhere(function ($query) {
                    $query->where('penguji1_id', auth()->user()->id)
                        ->orWhere('penguji2_id', auth()->user()->id)
                        ->orWhere('penguji3_id', auth()->user()->id);
                })
                ->latest()->get();

            return view('sempro.index', [
                'title' => 'E - Skripsi | Sempro',
                'sempros' => $sempros,
            ]);
        }

        $sempros = Sempro::with(['judul', 'judul.mahasiswa'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->latest()->get();

        return view('sempro.index', [
            'title' => 'E - Skripsi | Sempro',
            'sempros' => $sempros,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // akses mahasiswa
        $this->authorize('create', Sempro::class);

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
        // akses mahasiswa
        $this->authorize('create', Sempro::class);

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
    public function show(Sempro $sempro)
    {
        $sempros = $sempro->load(['judul', 'judul.mahasiswa.dokumen', 'penguji1', 'penguji2', 'penguji3']);

        return response()->json($sempros);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sempro $sempro)
    {
        // akses koordinator
        $this->authorize('update', $sempro);

        return view('sempro.edit', [
            'title' => 'Sempro | Edit',
            'sempro' => $sempro->load('judul'),
            'dosens' => User::where('role_id', 3)->latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sempro $sempro)
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

        $sempro->update($validateData);

        if ($sempro->status != 'perbaikan') {
            $sempro->update(['notes' => null]);
        }

        Alert::success('success!', 'Sempro has been updated');

        return redirect('/sempro');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sempro $sempro)
    {
        // akses mahasiswa
        $this->authorize('delete', $sempro);

        $semproId = $sempro->id;

        $judul = Judul::whereHas('sempro', function ($query) use ($semproId) {
            $query->where('id', $semproId);
        })->first();


        if ($sempro->pembayaran) {
            Storage::delete($sempro->pembayaran);
        }

        $sempro->delete();

        Kompre::where('judul_id', $judul->id)->delete();

        Alert::success('success!', 'Sempro has been deleted');

        return redirect('/sempro');
    }
}
