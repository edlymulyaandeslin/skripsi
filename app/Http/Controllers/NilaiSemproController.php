<?php

namespace App\Http\Controllers;

use App\Models\NilaiSempro;
use App\Models\Sempro;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiSemproController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sempro.nilai.index', [
            'title' => 'E - Skripsi | Nilai Sempro',
            'sempros' => Sempro::with('judul', 'judul.mahasiswa', 'penguji1', 'penguji2', 'penguji3', 'nilaisempro')->where('status', '!=', 'diajukan')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'sempro_id' => 'required',
        ];

        // input nilai form penguji 1
        if ($request->filled('nilai1')) {
            $rules['nilai1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2')) {
            $rules['nilai2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3')) {
            $rules['nilai3'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4')) {
            $rules['nilai4'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5')) {
            $rules['nilai5'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes1')) {
            $rules['notes1'] = 'required|max:255';
        }

        // input nilai form penguji 2
        if ($request->filled('nilai6')) {
            $rules['nilai6'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai7')) {
            $rules['nilai7'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai8')) {
            $rules['nilai8'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai9')) {
            $rules['nilai9'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai10')) {
            $rules['nilai10'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes2')) {
            $rules['notes2'] = 'required|max:255';
        }

        // input nilai form penguji 3
        if ($request->filled('nilai11')) {
            $rules['nilai11'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai12')) {
            $rules['nilai12'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai13')) {
            $rules['nilai13'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai14')) {
            $rules['nilai14'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai15')) {
            $rules['nilai15'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes3')) {
            $rules['notes3'] = 'required|max:255';
        }

        $validateData = $request->validate($rules);

        NilaiSempro::create($validateData);

        $sempro = Sempro::find($validateData['sempro_id']);

        $total1 = $sempro->nilaisempro->nilai1 + $sempro->nilaisempro->nilai2 + $sempro->nilaisempro->nilai3 + $sempro->nilaisempro->nilai4 + $sempro->nilaisempro->nilai5;

        $total2 = $sempro->nilaisempro->nilai6 + $sempro->nilaisempro->nilai7 + $sempro->nilaisempro->nilai8 + $sempro->nilaisempro->nilai9 + $sempro->nilaisempro->nilai10;

        $total3 = $sempro->nilaisempro->nilai11 + $sempro->nilaisempro->nilai12 + $sempro->nilaisempro->nilai13 + $sempro->nilaisempro->nilai14 + $sempro->nilaisempro->nilai15;

        $ratarata = number_format(($total1 + $total2 + $total3) / 3, 2);

        if ($ratarata > 75) {
            $sempro->update([
                'status' => 'lulus',
            ]);
        } else if ($ratarata <= 75) {
            $sempro->update([
                'status' => 'tidak lulus',
            ]);
        }

        Alert::success('Success!', 'Value entered successfully');

        return redirect('/nilai/sempro');
    }

    public function show($id)
    {
        $nilaiSempro = Sempro::with(['judul', 'judul.mahasiswa', 'penguji1', 'penguji2', 'penguji3', 'nilaisempro'])->find($id);

        return response()->json($nilaiSempro);
    }

    public function edit($id)
    {
        return view('sempro.nilai.edit', [
            'title' => 'Input Nilai',
            'sempro' => Sempro::with('judul', 'nilaisempro')->find($id),
        ]);
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'sempro_id' => 'required',
        ];
        // input nilai form penguji 1
        if ($request->filled('nilai1')) {
            $rules['nilai1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2')) {
            $rules['nilai2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3')) {
            $rules['nilai3'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4')) {
            $rules['nilai4'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5')) {
            $rules['nilai5'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes1')) {
            $rules['notes1'] = 'required|max:255';
        }

        // input nilai form penguji 2
        if ($request->filled('nilai6')) {
            $rules['nilai6'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai7')) {
            $rules['nilai7'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai8')) {
            $rules['nilai8'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai9')) {
            $rules['nilai9'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai10')) {
            $rules['nilai10'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes2')) {
            $rules['notes2'] = 'required|max:255';
        }

        // input nilai form penguji 3
        if ($request->filled('nilai11')) {
            $rules['nilai11'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai12')) {
            $rules['nilai12'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai13')) {
            $rules['nilai13'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai14')) {
            $rules['nilai14'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai15')) {
            $rules['nilai15'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes3')) {
            $rules['notes3'] = 'required|max:255';
        }

        $validateData = $request->validate($rules);

        NilaiSempro::where('id', $id)->update($validateData);

        $sempro = Sempro::find($validateData['sempro_id']);

        $total1 = $sempro->nilaisempro->nilai1 + $sempro->nilaisempro->nilai2 + $sempro->nilaisempro->nilai3 + $sempro->nilaisempro->nilai4 + $sempro->nilaisempro->nilai5;

        $total2 = $sempro->nilaisempro->nilai6 + $sempro->nilaisempro->nilai7 + $sempro->nilaisempro->nilai8 + $sempro->nilaisempro->nilai9 + $sempro->nilaisempro->nilai10;

        $total3 = $sempro->nilaisempro->nilai11 + $sempro->nilaisempro->nilai12 + $sempro->nilaisempro->nilai13 + $sempro->nilaisempro->nilai14 + $sempro->nilaisempro->nilai15;

        $ratarata = number_format(($total1 + $total2 + $total3) / 3, 2);

        if ($ratarata > 75) {
            $sempro->update([
                'status' => 'lulus',
            ]);
        } else if ($ratarata <= 75) {
            $sempro->update([
                'status' => 'tidak lulus',
            ]);
        }

        Alert::success('Success!', 'Value updated successfully');

        return redirect('/nilai/sempro');
    }
}
