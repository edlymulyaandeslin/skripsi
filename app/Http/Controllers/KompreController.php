<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\Kompre;
use App\Models\TeamPenguji;
use Illuminate\Http\Request;
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
            'kompres' => Kompre::with(['judul', 'judul.mahasiswa', 'teampenguji'])->latest()->get()
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
            })
            ->where('status', '!=', 'ditolak')
            ->get();

        // cek apakah sudah pernah mengajukan kompre atau tidak
        if ($kompre->count() !== 0) {

            Alert::info('Info!', 'You can only submit a comprehensive seminar 1x');

            return redirect('/kompre');
        }

        return view('kompre.create', [
            'title' => 'Kompre | Create',
            'juduls' => Judul::with(['mahasiswa', 'sempro'])
                ->whereHas('sempro', function ($query) {
                    $query->where('status', 'diterima');
                })
                ->where('mahasiswa_id', auth()->user()->id)
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul_id' => 'required'
        ]);

        Kompre::create($validateData);

        Alert::success('Success!', 'Successfully applied for a comprehensive seminar');

        return redirect('/kompre');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kompre = Kompre::with(['judul', 'judul.mahasiswa', 'teampenguji'])->find($id);

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
            'teampenguji' => TeamPenguji::latest()->get()

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

        if ($request->input('team_penguji_id')) {
            $rules['team_penguji_id'] = 'required';
        }

        if ($request->input('status')) {
            $rules['status'] = 'required';
        }

        $validateData = $request->validate($rules);

        Kompre::where('id', $id)->update($validateData);

        Alert::success('Success!', 'Komprehensif has been updated!');

        return redirect('/kompre');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kompre::destroy($id);

        Alert::success('Success!', 'Komprehensif has been deleted!');

        return redirect('/kompre');
    }
}
