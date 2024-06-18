<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Http\Requests\StoreDokumenRequest;
use App\Http\Requests\UpdateDokumenRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // confirm delete judul
        $title = 'Reset Dokumen!';
        $text = "Kamu yakin ingin mereset?";
        confirmDelete($title, $text);

        return view('manajemen.dokumen.index', [
            'title' => 'E - Skripsi | Lengkapi Dokumen',
            'user' => User::with('dokumen')->find(auth()->user()->id)
        ]);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'mahasiswa_id' => 'required',
            'krs' => 'required|file|mimes:pdf|max:2048',
            'transkip_nilai' => 'required|file|mimes:pdf|max:2048',
            'hadir_seminar' => 'required|file|mimes:pdf|max:2048',
        ]);

        $krs = 'document_' . str()->random(10) . '.' . $request->file('krs')->extension();
        $validateData['krs'] = $request->file('krs')->storeAs('doc', $krs);

        $transkipnilai = 'document_' . str()->random(10) . '.' . $request->file('transkip_nilai')->extension();
        $validateData['transkip_nilai'] = $request->file('transkip_nilai')->storeAs('doc', $transkipnilai);

        $hadirseminar = 'document_' . str()->random(10) . '.' . $request->file('hadir_seminar')->extension();
        $validateData['hadir_seminar'] = $request->file('hadir_seminar')->storeAs('doc', $hadirseminar);

        Dokumen::create($validateData);

        Alert::success('Berhasil', 'Dokumen telah diupload');

        return redirect(route('dokumen.index'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'mahasiswa_id' => 'required'
        ];

        if ($request->file('krs')) {
            $rules['krs'] = 'required|file|mimes:pdf|max:2048';
        }
        if ($request->file('transkip_nilai')) {
            $rules['transkip_nilai'] = 'required|file|mimes:pdf|max:2048';
        }
        if ($request->file('hadir_seminar')) {
            $rules['hadir_seminar'] = 'required|file|mimes:pdf|max:2048';
        }

        $validateData = $request->validate($rules);

        if ($request->file('krs')) {
            if ($request->oldKrs) {
                Storage::delete($request->oldKrs);
            }

            $krs = 'document_' . str()->random(10) . '.' . $request->file('krs')->extension();
            $validateData['krs'] = $request->file('krs')->storeAs('doc', $krs);
        }
        if ($request->file('transkip_nilai')) {
            if ($request->oldTranskip) {
                Storage::delete($request->oldTranskip);
            }

            $transkipnilai = 'document_' . str()->random(10) . '.' . $request->file('transkip_nilai')->extension();
            $validateData['transkip_nilai'] = $request->file('transkip_nilai')->storeAs('doc', $transkipnilai);
        }
        if ($request->file('hadir_seminar')) {
            if ($request->oldHadirSeminar) {
                Storage::delete($request->oldHadirSeminar);
            }

            $hadirseminar = 'document_' . str()->random(10) . '.' . $request->file('hadir_seminar')->extension();
            $validateData['hadir_seminar'] = $request->file('hadir_seminar')->storeAs('doc', $hadirseminar);
        }

        Dokumen::where('id', $id)->update($validateData);

        Alert::success('Berhasil', 'Dokumen telah diupload');

        return redirect(route('dokumen.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::find($id);
        if ($dokumen->krs) {
            Storage::delete($dokumen->krs);
        }
        if ($dokumen->transkip_nilai) {
            Storage::delete($dokumen->transkip_nilai);
        }
        if ($dokumen->hadir_seminar) {
            Storage::delete($dokumen->hadir_seminar);
        }

        $dokumen->delete();

        Alert::success('Berhasil', 'Dokumen telah reset');

        return redirect(route('dokumen.index'));
    }
}
