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
        // admin dan koordinator
        if (auth()->user()->role_id === 1 || auth()->user()->role_id === 2) {
            $kompres = Kompre::with('judul.mahasiswa', 'nilaikompre')
                ->whereNotIn('status', ['diajukan', 'perbaikan'])->latest()->get();

            return view('kompre.nilai.index', [
                'title' => 'E - Skripsi | Nilai Kompre',
                'kompres' => $kompres,
            ]);
        }

        // dosen
        if (auth()->user()->role_id === 3) {
            $kompres = Kompre::with('judul.mahasiswa', 'nilaikompre')
                ->whereHas('judul', function ($query) {
                    $query->where('pembimbing1_id', auth()->user()->id)
                        ->orWhere('pembimbing2_id', auth()->user()->id);
                })
                ->orWhere(function ($query) {
                    $query->where('penguji1_id', auth()->user()->id)
                        ->orWhere('penguji2_id', auth()->user()->id)
                        ->orWhere('penguji3_id', auth()->user()->id);
                })
                ->whereNotIn('status', ['diajukan', 'perbaikan'])->latest()->get();

            return view('kompre.nilai.index', [
                'title' => 'E - Skripsi | Nilai Kompre',
                'kompres' => $kompres,
            ]);
        }

        // mahasiswa
        $kompres = Kompre::with('judul.mahasiswa', 'nilaikompre')
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->whereNotIn('status', ['diajukan', 'perbaikan'])->latest()->get();

        return view('kompre.nilai.index', [
            'title' => 'E - Skripsi | Nilai Kompre',
            'kompres' => $kompres,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'kompre_id' => 'required',
        ];

        // input nilai form penguji 1
        if ($request->filled('nilai1_peng1')) {
            $rules['nilai1_peng1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2_peng1')) {
            $rules['nilai2_peng1'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_peng1')) {
            $rules['nilai3_peng1'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_peng1')) {
            $rules['nilai4_peng1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5_peng1')) {
            $rules['nilai5_peng1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes1')) {
            $rules['notes1'] = 'required|max:255';
        }

        // input nilai form penguji 2
        if ($request->filled('nilai1_peng2')) {
            $rules['nilai1_peng2'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2_peng2')) {
            $rules['nilai2_peng2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_peng2')) {
            $rules['nilai3_peng2'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_peng2')) {
            $rules['nilai4_peng2'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5_peng2')) {
            $rules['nilai5_peng2'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes2')) {
            $rules['notes2'] = 'required|max:255';
        }

        // input nilai form penguji 3
        if ($request->filled('nilai1_peng3')) {
            $rules['nilai1_peng3'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2_peng3')) {
            $rules['nilai2_peng3'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_peng3')) {
            $rules['nilai3_peng3'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_peng3')) {
            $rules['nilai4_peng3'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5_peng3')) {
            $rules['nilai5_peng3'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes3')) {
            $rules['notes3'] = 'required|max:255';
        }

        // input nilai form pembimbing 1
        if ($request->filled('nilai1_pem1')) {
            $rules['nilai1_pem1'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai2_pem1')) {
            $rules['nilai2_pem1'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_pem1')) {
            $rules['nilai3_pem1'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_pem1')) {
            $rules['nilai4_pem1'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai5_pem1')) {
            $rules['nilai5_pem1'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai6_pem1')) {
            $rules['nilai6_pem1'] = 'required|numeric|min:0|max:20';
        }
        if ($request->filled('nilai7_pem1')) {
            $rules['nilai7_pem1'] = 'required|numeric|min:0|max:20';
        }

        // input nilai form pembimbing 2
        if ($request->filled('nilai1_pem2')) {
            $rules['nilai1_pem2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai2_pem2')) {
            $rules['nilai2_pem2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_pem2')) {
            $rules['nilai3_pem2'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_pem2')) {
            $rules['nilai4_pem2'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai5_pem2')) {
            $rules['nilai5_pem2'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai6_pem2')) {
            $rules['nilai6_pem2'] = 'required|numeric|min:0|max:20';
        }
        if ($request->filled('nilai7_pem2')) {
            $rules['nilai7_pem2'] = 'required|numeric|min:0|max:20';
        }

        $validateData = $request->validate($rules);

        NilaiKompre::create($validateData);

        Alert::success('Success!', 'Value entered successfully');

        return redirect('/nilai/kompre');
    }


    public function show(Kompre $kompre)
    {
        $kompres = $kompre->load(['judul', 'judul.mahasiswa', 'penguji1', 'penguji2', 'penguji3', 'nilaikompre']);

        return response()->json($kompres);
    }


    public function edit(Kompre $kompre, NilaiKompre $nilaikompre)
    {
        // akses sesuai pembimbing dan penguji
        $this->authorize('update', $nilaikompre);

        return view('kompre.nilai.edit', [
            'title' => 'Input Nilai',
            'kompre' => $kompre->load('judul', 'judul.pembimbing1', 'judul.pembimbing2', 'nilaikompre', 'penguji1', 'penguji2', 'penguji3'),
        ]);
    }

    public function update(Request $request, $id, NilaiKompre $nilaikompre)
    {
        // akses sesuai pembimbing dan penguji
        $this->authorize('update', $nilaikompre);

        $rules = [
            'kompre_id' => 'required',
        ];
        // input nilai form penguji 1
        if ($request->filled('nilai1_peng1')) {
            $rules['nilai1_peng1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2_peng1')) {
            $rules['nilai2_peng1'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_peng1')) {
            $rules['nilai3_peng1'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_peng1')) {
            $rules['nilai4_peng1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5_peng1')) {
            $rules['nilai5_peng1'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes1')) {
            $rules['notes1'] = 'required|max:255';
        }

        // input nilai form penguji 2
        if ($request->filled('nilai1_peng2')) {
            $rules['nilai1_peng2'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2_peng2')) {
            $rules['nilai2_peng2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_peng2')) {
            $rules['nilai3_peng2'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_peng2')) {
            $rules['nilai4_peng2'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5_peng2')) {
            $rules['nilai5_peng2'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes2')) {
            $rules['notes2'] = 'required|max:255';
        }

        // input nilai form penguji 3
        if ($request->filled('nilai1_peng3')) {
            $rules['nilai1_peng3'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai2_peng3')) {
            $rules['nilai2_peng3'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_peng3')) {
            $rules['nilai3_peng3'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_peng3')) {
            $rules['nilai4_peng3'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('nilai5_peng3')) {
            $rules['nilai5_peng3'] = 'required|numeric|min:0|max:25';
        }
        if ($request->filled('notes3')) {
            $rules['notes3'] = 'required|max:255';
        }

        // input nilai form pembimbing 1
        if ($request->filled('nilai1_pem1')) {
            $rules['nilai1_pem1'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai2_pem1')) {
            $rules['nilai2_pem1'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_pem1')) {
            $rules['nilai3_pem1'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_pem1')) {
            $rules['nilai4_pem1'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai5_pem1')) {
            $rules['nilai5_pem1'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai6_pem1')) {
            $rules['nilai6_pem1'] = 'required|numeric|min:0|max:20';
        }
        if ($request->filled('nilai7_pem1')) {
            $rules['nilai7_pem1'] = 'required|numeric|min:0|max:20';
        }

        // input nilai form pembimbing 2
        if ($request->filled('nilai1_pem2')) {
            $rules['nilai1_pem2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai2_pem2')) {
            $rules['nilai2_pem2'] = 'required|numeric|min:0|max:15';
        }
        if ($request->filled('nilai3_pem2')) {
            $rules['nilai3_pem2'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai4_pem2')) {
            $rules['nilai4_pem2'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai5_pem2')) {
            $rules['nilai5_pem2'] = 'required|numeric|min:0|max:10';
        }
        if ($request->filled('nilai6_pem2')) {
            $rules['nilai6_pem2'] = 'required|numeric|min:0|max:20';
        }
        if ($request->filled('nilai7_pem2')) {
            $rules['nilai7_pem2'] = 'required|numeric|min:0|max:20';
        }

        $validateData = $request->validate($rules);

        NilaiKompre::where('id', $id)->update($validateData);

        $kompre = Kompre::find($validateData['kompre_id']);

        $nilaiPenguji1 = $kompre->nilaikompre->nilai1_peng1 + $kompre->nilaikompre->nilai2_peng1 + $kompre->nilaikompre->nilai3_peng1 + $kompre->nilaikompre->nilai4_peng1 + $kompre->nilaikompre->nilai5_peng1;

        $nilaiPenguji2 = $kompre->nilaikompre->nilai1_peng2 + $kompre->nilaikompre->nilai2_peng2 + $kompre->nilaikompre->nilai3_peng2 + $kompre->nilaikompre->nilai4_peng2 + $kompre->nilaikompre->nilai5_peng2;

        $nilaiPenguji3 = $kompre->nilaikompre->nilai1_peng3 + $kompre->nilaikompre->nilai2_peng3 + $kompre->nilaikompre->nilai3_peng3 + $kompre->nilaikompre->nilai4_peng3 + $kompre->nilaikompre->nilai5_peng3;

        $nilaiPem1 = $kompre->nilaikompre->nilai1_pem1 + $kompre->nilaikompre->nilai2_pem1 + $kompre->nilaikompre->nilai3_pem1 + $kompre->nilaikompre->nilai4_pem1 + $kompre->nilaikompre->nilai5_pem1 + $kompre->nilaikompre->nilai6_pem1 + $kompre->nilaikompre->nilai7_pem1;

        $nilaiPem2 = $kompre->nilaikompre->nilai1_pem2 + $kompre->nilaikompre->nilai2_pem2 + $kompre->nilaikompre->nilai3_pem2 + $kompre->nilaikompre->nilai4_pem2 + $kompre->nilaikompre->nilai5_pem2 + $kompre->nilaikompre->nilai6_pem2 + $kompre->nilaikompre->nilai7_pem2;

        $ratarata = number_format(($nilaiPenguji1 + $nilaiPenguji2 + $nilaiPenguji3 + $nilaiPem1 + $nilaiPem2) / 5, 2);

        if (!$nilaiPem1 || !$nilaiPem2 || !$nilaiPenguji1 || !$nilaiPenguji2 || !$nilaiPenguji3) {
            $kompre->update([
                'status' => 'penilaian',
            ]);
        } else if ($ratarata >= 75) {
            $kompre->update([
                'status' => 'lulus',
            ]);
        } else {
            $kompre->update([
                'status' => 'tidak lulus',
            ]);
        }

        Alert::success('Success!', 'Value updated successfully');

        return redirect('/nilai/kompre');
    }
}
