<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class JudulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // confirm delete judul
        $title = 'Delete Judul!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        // jika dia admin atau koordinator tampilkan semua judul
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            return view('judul.index', [
                'title' => 'E - Skripsi | Judul',
                'listjudul' => Judul::with(['mahasiswa', 'pembimbing1', 'pembimbing2', 'logbook'])->whereIn('status', ['diajukan', 'diterima'])->latest()->get(),
            ]);
        }

        // jika dia dosen tampilkan berdasarkan dia sebagai pembimbing
        if (auth()->user()->role_id == 3) {
            $listjudul = Judul::with(['mahasiswa', 'pembimbing1', 'pembimbing2', 'logbook'])->where(function ($query) {
                $query->orWhere('pembimbing1_id', auth()->user()->id)
                    ->orWhere('pembimbing2_id', auth()->user()->id);
            })->get();

            return view('judul.index', [
                'title' => 'E - Skripsi | Judul',
                'listjudul' => $listjudul,
            ]);
        }

        // jika dia mahasiswa tampilkan judul yang dimiliki mahasiswa tersebut mahasiswa
        return view('judul.index', [
            'title' => 'E - Skripsi | Judul',
            'listjudul' => Judul::with(['mahasiswa', 'pembimbing1', 'pembimbing2', 'logbook'])->where('mahasiswa_id', auth()->user()->id)->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Judul $judul)
    {
        // akses mahasiswa
        $this->authorize('create', $judul);

        return view('judul.create', [
            'title' => 'Judul | Create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // akses mahasiswa
        $this->authorize('create', Judul::class);

        $validateData = $request->validate([
            'judul' => 'required',
            'latar_belakang' => 'required'
        ]);

        $validateData['mahasiswa_id'] = auth()->user()->id;

        Judul::create($validateData);

        Alert::success('success', 'Judul has been created');

        return redirect('/judul');
    }

    /**
     * Display the specified resource.
     */
    public function show(Judul $judul)
    {
        $judul = $judul->load(['mahasiswa', 'pembimbing1', 'pembimbing2', 'logbook']);

        return response()->json($judul);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Judul $judul)
    {
        // akses koordinator
        $this->authorize('update', $judul);

        return view('judul.edit', [
            'title' => 'Judul | Edit',
            'judul' => $judul->load(['mahasiswa',  'pembimbing1', 'pembimbing2']),
            'dosens' => User::where('role_id', 3)->get(),
            'alljudul' => Judul::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Judul $judul)
    {
        // akses koordinator
        $this->authorize('update', $judul);

        $mahasiswaId = $judul->mahasiswa_id;

        $rules = [
            'pembimbing1_id' => 'required',
            'pembimbing2_id' => 'required',
            'status' => 'required',
        ];

        $validateData = $request->validate($rules);

        $judul->update($validateData);

        // jika 1 judul diterima maka yang lain akan ditolak
        if ($judul->status == 'diterima') {
            Judul::where('mahasiswa_id', $mahasiswaId)->whereNotIn('id', [$judul->id])->update([
                'status' => 'ditolak',
                'pembimbing1_id' => 0,
                'pembimbing2_id' => 0
            ]);
        }

        Alert::success('success!', 'Judul has been updated');

        return redirect('/judul');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Judul $judul)
    {
        // akses mahasiswa
        $this->authorize('delete', $judul);

        $logbook = $judul->logbook;

        $sempros = $judul->sempro;

        foreach ($logbook as $log) {
            if ($log->file_proposal) {
                Storage::delete($log->file_proposal);
            }
        }

        foreach ($sempros as $sempro) {
            if ($sempro->pembayaran) {
                Storage::delete($sempro->pembayaran);
            }
        }

        $judul->delete();

        Alert::success('success!', 'Judul has been deleted');

        return redirect('/judul');
    }
}
