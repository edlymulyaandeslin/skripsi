<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Judul;
use App\Models\Kompre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class KompreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // confirm delete judul
        $title = 'Batalkan Komprehensif!';
        $text = "Kamu Yakin Ingin Membatalkan?";
        confirmDelete($title, $text);

        // admin atau koordinator
        if (auth()->user()->role_id === 1 || auth()->user()->role_id === 2) {
            $kompres = Kompre::with(['judul.mahasiswa'])
                ->whereNotIn('status', ['lulus'])
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString();

            return view('kompre.index', [
                'title' => 'E - Skripsi | Komprehensif',
                'kompres' => $kompres,
            ]);
        }

        // dosen
        if (auth()->user()->role_id === 3) {
            $kompres = Kompre::with('judul.mahasiswa')
                ->whereNotIn('status', ['diajukan', 'perbaikan', 'lulus'])
                ->where(function ($query) {
                    $query->where('penguji1_id', auth()->user()->id)
                        ->orWhere('penguji2_id', auth()->user()->id)
                        ->orWhere('penguji3_id', auth()->user()->id)
                        ->orWhere(function ($query) {
                            $query->whereHas('judul', function ($subquery) {
                                $subquery->where('pembimbing1_id', auth()->user()->id)
                                    ->orWhere('pembimbing2_id', auth()->user()->id);
                            });
                        });
                })
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString();

            return view('kompre.index', [
                'title' => 'E - Skripsi | Komprehensif',
                'kompres' => $kompres,
            ]);
        }

        $kompres = Kompre::with(['judul.mahasiswa'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->latest()
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        if ($kompres->count() == 0) {
            return redirect('/kompre/create');
        }

        return view('kompre.index', [
            'title' => 'E - Skripsi | Komprehensif',
            'kompres' => $kompres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // akses mahasiswa
        $this->authorize('create', Kompre::class);

        // find data kompre berdasarkan id mahasiswa yg login dan statusnya != ditolak
        $kompre = Kompre::with(['judul'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })->where('status', '!=', 'tidak lulus')
            ->get();

        // find judul berdasarkan logbook dengan status acc komprehensif dan sempro dengan statuus lulus
        $juduls = Judul::withCount(['logbook as acc_komprehensif_count' => function ($query) {
            $query->where('status', 'acc komprehensif')->where('kategori', 'komprehensif');
        }])
            ->with(['mahasiswa', 'mahasiswa.dokumen', 'logbook', 'sempro'])->whereHas('logbook', function ($query) {
                $query->where('status', 'acc komprehensif');
            })
            ->whereHas('sempro', function ($query) {
                $query->where('status', 'lulus');
            })
            ->where('mahasiswa_id', auth()->user()->id)
            ->having('acc_komprehensif_count', '>=', 2)
            ->latest()
            ->get();
        if ($juduls->count() == 0) {
            Alert::warning('Info', 'Anda Harus Lulus Seminar Proposal dan Selesaikan Bimbingan Komprehensif');
            return redirect('/logbook');
        }

        $dokumen = auth()->user()->dokumen;

        return view('kompre.create', [
            'title' => 'Komprehensif | Pendaftaran',
            'juduls' => $juduls,
            'kompre' => $kompre,
            'dokumen' => $dokumen
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //akses mahasiswa
        $this->authorize('create', Kompre::class);

        $validateData = $request->validate([
            'judul_id' => 'required',
            'pembayaran' => 'required|file|mimes:pdf|max:2048',
            'lembar_bimbingan' => 'required|file|mimes:pdf|max:2048'
        ]);

        $pembayaran = 'document_' . str()->random(10) . '.' . $request->file('pembayaran')->extension();
        $validateData['pembayaran'] = $request->file('pembayaran')->storeAs('post-pembayaran', $pembayaran);

        $lembarbimbingan = 'document_' . str()->random(10) . '.' . $request->file('lembar_bimbingan')->extension();
        $validateData['lembar_bimbingan'] = $request->file('lembar_bimbingan')->storeAs('doc-bimbingan', $lembarbimbingan);

        Kompre::where('status', 'tidak lulus')->get()->each(function ($kompre) {
            Storage::delete($kompre->pembayaran);
            Storage::delete($kompre->lembar_bimbingan);
            $kompre->delete();
        });

        Kompre::create($validateData);

        Alert::success('Berhasil', 'Seminar Komprehensif Telah Diajukan');

        return redirect('/kompre');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kompre $kompre)
    {
        $kompre = $kompre->load(['judul.mahasiswa.dokumen', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3']);

        return response()->json($kompre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kompre $kompre)
    {
        // akses koordinator
        $this->authorize('update', $kompre);

        $dosens = User::where('role_id', 3)->latest()->get();
        $allkompre = Kompre::whereIn('status', ['diterima', 'penilaian'])->latest()->get();


        return view('kompre.edit', [
            'title' => 'Komprehensif | Verifikasi',
            'kompre' => $kompre->load('judul'),
            'dosens' => $dosens,
            'allkompre' => $allkompre
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kompre $kompre)
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
            $rules['penguji1_id'] = 'nullable';
            $rules['penguji2_id'] = 'nullable';
            $rules['penguji3_id'] = 'nullable';
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

        if ($request->file('lembar_bimbingan')) {
            $rules['lembar_bimbingan'] = 'required|file|mimes:pdf|max:2048';
        }

        $validateData = $request->validate($rules);

        if ($request->file('pembayaran')) {
            if ($request->oldPembayaran) {
                Storage::delete($request->oldPembayaran);
            }

            $pembayaran = 'document_' . str()->random(10) . '.' . $request->file('pembayaran')->extension();
            $validateData['pembayaran'] = $request->file('pembayaran')->storeAs('post-pembayaran', $pembayaran);
        }


        if ($request->file('lembar_bimbingan')) {
            if ($request->oldLembarBimbingan) {
                Storage::delete($request->oldLembarBimbingan);
            }

            $lembarbimbingan = 'document_' . str()->random(10) . '.' . $request->file('lembar_bimbingan')->extension();
            $validateData['lembar_bimbingan'] = $request->file('lembar_bimbingan')->storeAs('doc-bimbingan', $lembarbimbingan);
        }

        $kompre->update($validateData);

        if ($kompre->status != 'perbaikan') {
            $kompre->update(['notes' => null]);
        }

        Alert::success('Berhasil', 'Verifikasi Seminar Komprehensif');

        return redirect('/kompre');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kompre $kompre)
    {
        // akses mahasiswa
        $this->authorize('delete', $kompre);

        if ($kompre->pembayaran) {
            Storage::delete($kompre->pembayaran);
        }

        $kompre->delete();

        Alert::success('Berhasil', 'Pengajuan Seminar Komprehensif Dibatalkan');

        return redirect('/kompre');
    }
}
