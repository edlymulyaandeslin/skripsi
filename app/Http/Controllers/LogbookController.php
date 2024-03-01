<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\Logbook;
use App\Models\User;
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
        // akses != koordinator
        $this->authorize('viewAny', Logbook::class);

        // confirm delete judul
        $title = 'Batalkan Bimbingan!';
        $text = "Kamu yakin ingin membatalkan?";
        confirmDelete($title, $text);

        if (auth()->user()->role_id == 1) {
            $logbooks = Logbook::with(['judul', 'judul.mahasiswa'])
                ->whereHas('judul.mahasiswa', function ($query) {
                    $query->where('status', 'active');
                })
                ->latest()
                ->filter(request(['search']))
                ->paginate(10);

            return view('logbook.index', [
                'title' => 'E - Skripsi | Bimbingan',
                'logbooks' => $logbooks
            ]);
        }

        if (auth()->user()->role_id == 3) {
            $logbooks = Logbook::with(['judul', 'judul.mahasiswa'])
                ->whereHas('judul.mahasiswa', function ($query) {
                    $query->where('status', 'active');
                })
                ->where('pembimbing_id', auth()->user()->id)
                ->latest()
                ->filter(request(['search']))
                ->paginate(10);

            return view('logbook.index', [
                'title' => 'E - Skripsi | Bimbingan',
                'logbooks' => $logbooks
            ]);
        }

        $logbooks = Logbook::with(['judul', 'pembimbing'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })->latest()
            ->filter(request(['search']))
            ->paginate(10);

        // untuk validasi menampilkan btn print bimbingan proposal dan komprehensif
        $logbooksAccProposal = Logbook::with(['judul'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->where('status', 'acc proposal')->latest()->get();

        $logbooksAccKomprehensif = Logbook::with(['judul'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->where('status', 'acc komprehensif')->latest()->get();

        return view('logbook.index', [
            'title' => 'E - Skripsi | Bimbingan',
            'logbooks' => $logbooks,
            'accProposal' => $logbooksAccProposal,
            'accKomprehensif' => $logbooksAccKomprehensif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // akses mahasiswa
        $this->authorize('create', Logbook::class);
        $juduls = Judul::with('mahasiswa', 'pembimbing1', 'pembimbing2')->where('status', 'diterima')->where('mahasiswa_id', auth()->user()->id)->latest()->get();

        if ($juduls->count() == 0) {
            Alert::error('Opsss', 'Belum ada judul yang diterima');
            return redirect('/logbook');
        }
        return view('logbook.create', [
            'title' => 'Bimbingan | Pengajuan',
            'juduls' => $juduls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // akses mahasiswa
        $this->authorize('create', Logbook::class);

        $validateData = $request->validate([
            'judul_id' => 'required',
            'target_bimbingan' => 'required',
            'file_proposal' => 'required|file|mimes:pdf|max:5000',
            'kategori' => 'required',
            'pembimbing_id' => 'required'
        ]);

        $originalName = mt_rand(1, 99999) . '_' . $request->file('file_proposal')->getClientOriginalName();
        $validateData['file_proposal'] = $request->file('file_proposal')->storeAs('logbook', $originalName);

        Logbook::create($validateData);

        Alert::success('Berhasil', 'Bimbingan Telah Diajukan');

        return redirect('/logbook');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logbook $logbook)
    {
        $logbooks = $logbook->load(['judul', 'judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2']);

        return response()->json($logbooks);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logbook $logbook)
    {
        // akses pembimbing
        $this->authorize('update', $logbook);

        return view('logbook.edit', [
            'title' => 'Bimbingan | Verifikasi',
            'logbook' => $logbook->load('judul'),
            'juduls' => Judul::where('status', 'diterima')->latest()->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logbook $logbook)
    {
        // akses pembimbing
        $this->authorize('update', $logbook);

        $rules = [
            'status' => 'required',
        ];

        if ($request->filled('hasil')) {
            $rules['hasil'] = 'required';
        }

        $validateData = $request->validate($rules);

        $logbook->update($validateData);

        Alert::success('Berhasil', 'Verifikasi Bimbingan');

        return redirect('/logbook');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        // akses mahasiswa
        $this->authorize('delete', $logbook);

        if ($logbook->file_proposal) {
            Storage::delete($logbook->file_proposal);
        }

        $logbook->delete();

        Alert::success('Berhasil', 'Bimbingan Telah Dibatalkan');

        return redirect('/logbook');
    }
}
