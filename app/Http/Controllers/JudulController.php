<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judul;
use App\Models\Logbook;
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
        $title = 'Batalkan Pengajuan Judul!';
        $text = "Kamu yakin ingin membatalkan?";
        confirmDelete($title, $text);

        // jika dia admin atau koordinator tampilkan semua judul
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            $listjudul = Judul::with(
                ['mahasiswa', 'pembimbing1', 'pembimbing2', 'logbook']
            )->whereHas('mahasiswa', function ($query) {
                $query->where('status', 'active');
            })->whereIn('status', ['diajukan', 'diterima'])
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString();

            return view('judul.index', [
                'title' => 'E - Skripsi | Judul',
                'listjudul' => $listjudul,
            ]);
        }

        // jika dia dosen tampilkan berdasarkan dia sebagai pembimbing
        if (auth()->user()->role_id == 3) {
            $listjudul = Judul::with(['mahasiswa', 'pembimbing1', 'pembimbing2', 'logbook'])->where(function ($query) {
                $query->orWhere('pembimbing1_id', auth()->user()->id)
                    ->orWhere('pembimbing2_id', auth()->user()->id);
            })->whereHas('mahasiswa', function ($query) {
                $query->where('status', 'active');
            })
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString();

            return view('judul.index', [
                'title' => 'E - Skripsi | Judul',
                'listjudul' => $listjudul,
            ]);
        }

        $listjudul = Judul::with(['mahasiswa', 'pembimbing1', 'pembimbing2', 'logbook'])
            ->where('mahasiswa_id', auth()->user()->id)
            ->latest()
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        // jika dia mahasiswa tampilkan judul yang dimiliki mahasiswa tersebut mahasiswa
        return view('judul.index', [
            'title' => 'E - Skripsi | Judul',
            'listjudul' => $listjudul,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Judul $judul)
    {
        // akses mahasiswa
        $this->authorize('create', $judul);

        $judul = Judul::where('mahasiswa_id', auth()->user()->id)->latest()->get();

        if ($judul->count() >= 3) {
            Alert::error('Opsss', 'Pengajuan Judul Hanya Dapat Dilakukan 3 Kali');
            return redirect('/judul');
        }

        return view('judul.create', [
            'title' => 'Judul | Pengajuan'
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

        Alert::success('Berhasil', 'Judul Telah Diajukan');

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

        $dosens = User::where('role_id', 3)->latest()->get();
        $alljudul = Judul::where('status', 'diterima')->latest()->get();

        return view('judul.edit', [
            'title' => 'Judul | Verifikasi',
            'judul' => $judul->load(['mahasiswa',  'pembimbing1', 'pembimbing2']),
            'dosens' => $dosens,
            'alljuduls' => $alljudul
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
            'status' => 'required',
        ];
        if ($request->filled('pembimbing1_id')) {
            $rules['pembimbing1_id'] = 'required';
        }
        if ($request->filled('pembimbing2_id')) {
            $rules['pembimbing2_id'] = 'required';
        }

        $validateData = $request->validate($rules);

        // update logbook yang pembimbing_id nya sama dengan judul->pembimbing1_id || judul->pembimbing2_id
        if ($request->filled('pembimbing1_id')) {
            Logbook::with('judul')->whereHas('judul', function ($query) use ($mahasiswaId) {
                $query->where('mahasiswa_id', $mahasiswaId);
            })->where('pembimbing_id', $judul->pembimbing1_id)->update([
                'pembimbing_id' => $request->pembimbing1_id
            ]);
        }

        if ($request->filled('pembimbing2_id')) {
            Logbook::with('judul')->whereHas('judul', function ($query) use ($mahasiswaId) {
                $query->where('mahasiswa_id', $mahasiswaId);
            })->where('pembimbing_id', $judul->pembimbing2_id)->update([
                'pembimbing_id' => $request->pembimbing2_id
            ]);
        }

        $judul->update($validateData);

        // jika 1 judul diterima maka yang lain akan ditolak
        if ($judul->status == 'diterima') {
            Judul::where('mahasiswa_id', $mahasiswaId)->whereNotIn('id', [$judul->id])->update([
                'status' => 'ditolak',
                'pembimbing1_id' => null,
                'pembimbing2_id' => null
            ]);
        }

        Alert::success('Berhasil', 'Verifikasi Judul');

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

        Alert::success('Berhasil', 'Pengajuan Judul Dibatalkan');

        return redirect('/judul');
    }
}
