<?php

namespace App\Http\Controllers;

use App\Models\Kompre;
use App\Models\NilaiKompre;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiKompreController extends Controller
{

    public function index()
    {
        return view('kompre.nilai.index', [
            'title' => 'E - Skripsi | Nilai kompre',
            'kompres' => Kompre::with('judul', 'judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaikompre')->whereNotIn('status', ['diajukan', 'perbaikan'])->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'kompre_id' => 'required',
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

        NilaiKompre::create($validateData);

        $kompre = Kompre::find($validateData['kompre_id']);

        $total1 = $kompre->nilaikompre->nilai1 + $kompre->nilaikompre->nilai2 + $kompre->nilaikompre->nilai3 + $kompre->nilaikompre->nilai4 + $kompre->nilaikompre->nilai5;

        $total2 = $kompre->nilaikompre->nilai6 + $kompre->nilaikompre->nilai7 + $kompre->nilaikompre->nilai8 + $kompre->nilaikompre->nilai9 + $kompre->nilaikompre->nilai10;

        $total3 = $kompre->nilaikompre->nilai11 + $kompre->nilaikompre->nilai12 + $kompre->nilaikompre->nilai13 + $kompre->nilaikompre->nilai14 + $kompre->nilaikompre->nilai15;

        $ratarata = number_format(($total1 + $total2 + $total3) / 3, 2);

        if ($ratarata > 75) {
            $kompre->update([
                'status' => 'lulus',
            ]);
        } else if ($ratarata <= 75) {
            $kompre->update([
                'status' => 'tidak lulus',
            ]);
        }

        Alert::success('Success!', 'Value entered successfully');

        return redirect('/nilai/kompre');
    }


    public function show($id)
    {
        $nilaiKompre = Kompre::with(['judul', 'judul.mahasiswa', 'penguji1', 'penguji2', 'penguji3', 'nilaikompre'])->find($id);

        return response()->json($nilaiKompre);
    }


    public function edit($id)
    {
        return view('kompre.nilai.edit', [
            'title' => 'Input Nilai',
            'kompre' => Kompre::with('judul', 'judul.pembimbing1', 'judul.pembimbing2', 'nilaikompre', 'penguji1', 'penguji2', 'penguji3')->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'kompre_id' => 'required',
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

        NilaiKompre::where('id', $id)->update($validateData);

        $kompre = Kompre::find($validateData['kompre_id']);

        $total1 = $kompre->nilaikompre->nilai1 + $kompre->nilaikompre->nilai2 + $kompre->nilaikompre->nilai3 + $kompre->nilaikompre->nilai4 + $kompre->nilaikompre->nilai5;

        $total2 = $kompre->nilaikompre->nilai6 + $kompre->nilaikompre->nilai7 + $kompre->nilaikompre->nilai8 + $kompre->nilaikompre->nilai9 + $kompre->nilaikompre->nilai10;

        $total3 = $kompre->nilaikompre->nilai11 + $kompre->nilaikompre->nilai12 + $kompre->nilaikompre->nilai13 + $kompre->nilaikompre->nilai14 + $kompre->nilaikompre->nilai15;

        $ratarata = number_format(($total1 + $total2 + $total3) / 3, 2);

        if ($ratarata > 75) {
            $kompre->update([
                'status' => 'lulus',
            ]);
        } else if ($ratarata <= 75) {
            $kompre->update([
                'status' => 'tidak lulus',
            ]);
        }

        Alert::success('Success!', 'Value updated successfully');

        return redirect('/nilai/kompre');
    }
}
