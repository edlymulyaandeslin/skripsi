<?php

namespace App\Http\Controllers;

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
        $title = 'Delete Seminar Komprehensif!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('kompre.index', [
            'title' => 'E - Skripsi | Kompre',
            'kompres' => Kompre::with(['judul', 'judul.mahasiswa'])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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

        $dokumen = auth()->user()->dokumen;


        return view('kompre.create', [
            'title' => 'Kompre | Create',
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
        $validateData = $request->validate([
            'judul_id' => 'required',
            'pembayaran' => 'required|file|mimes:pdf|max:2048',
        ]);

        $pembayaran = 'document_' . str()->random(10) . '.' . $request->file('pembayaran')->extension();
        $validateData['pembayaran'] = $request->file('pembayaran')->storeAs('post-pembayaran', $pembayaran);

        Kompre::where('status', 'tidak lulus')->get()->each(function ($kompre) {
            Storage::delete($kompre->pembayaran);
            $kompre->delete();
        });

        Kompre::create($validateData);

        Alert::success('Success!', 'Successfully applied for a comprehensive seminar');

        return redirect('/kompre');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kompre = Kompre::with(['judul', 'judul.mahasiswa.dokumen'])->find($id);

        return response()->json($kompre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('kompre.edit', [
            'title' => 'Kompre | Edit',
            'kompre' => Kompre::with('judul')->find($id),
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

        Kompre::where('id', $id)->update($validateData);

        Alert::success('Success!', 'Komprehensif has been updated!');

        return redirect('/kompre');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kompre = Kompre::find($id);

        if ($kompre->pembayaran) {
            Storage::delete($kompre->pembayaran);
        }

        $kompre->destroy($id);

        Alert::success('Success!', 'Komprehensif has been deleted!');

        return redirect('/kompre');
    }
}
