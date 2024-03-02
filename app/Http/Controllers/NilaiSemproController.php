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
        // admin dan koordinator
        if (auth()->user()->role_id === 1 || auth()->user()->role_id === 2) {
            $sempros = Sempro::with('judul.mahasiswa', 'nilaisempro')
                ->whereNotIn('status', ['diajukan', 'perbaikan', 'lulus'])
                ->latest()
                ->filter(request(['search']))
                ->paginate(10)
                ->withQueryString();

            return view('sempro.nilai.index', [
                'title' => 'Seminar Proposal | Penilaian',
                'sempros' => $sempros,
            ]);
        }

        // dosen
        if (auth()->user()->role_id === 3) {
            $sempros = Sempro::with('judul.mahasiswa', 'nilaisempro')
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

            return view('sempro.nilai.index', [
                'title' => 'Seminar Proposal | Penilaian',
                'sempros' => $sempros,
            ]);
        }

        // mahasiswa
        $sempros = Sempro::with('judul.mahasiswa', 'nilaisempro')
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->whereNotIn('status', ['diajukan', 'perbaikan'])
            ->latest()
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        if ($sempros->count() == 0) {
            Alert::info('Info', 'Kamu Belum Mengajukan Seminar Proposal');
            return redirect()->route('sempro.create');
        }
        return view('sempro.nilai.index', [
            'title' => 'Seminar Proposal | Penilaian',
            'sempros' => $sempros,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'sempro_id' => 'required',
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

        NilaiSempro::create($validateData);

        Alert::success('Berhasil', 'Input Nilai Seminar Proposal');

        return redirect('/nilai/sempro');
    }

    public function show(Sempro $sempro)
    {
        $sempros = $sempro->load(['judul.mahasiswa', 'nilaisempro']);

        return response()->json($sempros);
    }

    public function edit(Sempro $sempro, NilaiSempro $nilaisempro)
    {
        // akses sesuai pembimbing dan penguji
        $this->authorize('update', $nilaisempro);

        return view('sempro.nilai.edit', [
            'title' => 'Seminar Proposal | Input Nilai',
            'sempro' => $sempro->load('judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaisempro'),
        ]);
    }


    public function update(Request $request, $id, NilaiSempro $nilaisempro)
    {
        // akses sesuai pembimbing dan penguji
        $this->authorize('update', $nilaisempro);

        $rules = [
            'sempro_id' => 'required',
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

        NilaiSempro::where('id', $id)->update($validateData);

        $sempro = Sempro::find($validateData['sempro_id']);

        $nilaiPenguji1 = $sempro->nilaisempro->nilai1_peng1 + $sempro->nilaisempro->nilai2_peng1 + $sempro->nilaisempro->nilai3_peng1 + $sempro->nilaisempro->nilai4_peng1 + $sempro->nilaisempro->nilai5_peng1;

        $nilaiPenguji2 = $sempro->nilaisempro->nilai1_peng2 + $sempro->nilaisempro->nilai2_peng2 + $sempro->nilaisempro->nilai3_peng2 + $sempro->nilaisempro->nilai4_peng2 + $sempro->nilaisempro->nilai5_peng2;

        $nilaiPenguji3 = $sempro->nilaisempro->nilai1_peng3 + $sempro->nilaisempro->nilai2_peng3 + $sempro->nilaisempro->nilai3_peng3 + $sempro->nilaisempro->nilai4_peng3 + $sempro->nilaisempro->nilai5_peng3;

        $nilaiPem1 = $sempro->nilaisempro->nilai1_pem1 + $sempro->nilaisempro->nilai2_pem1 + $sempro->nilaisempro->nilai3_pem1 + $sempro->nilaisempro->nilai4_pem1 + $sempro->nilaisempro->nilai5_pem1 + $sempro->nilaisempro->nilai6_pem1 + $sempro->nilaisempro->nilai7_pem1;

        $nilaiPem2 = $sempro->nilaisempro->nilai1_pem2 + $sempro->nilaisempro->nilai2_pem2 + $sempro->nilaisempro->nilai3_pem2 + $sempro->nilaisempro->nilai4_pem2 + $sempro->nilaisempro->nilai5_pem2 + $sempro->nilaisempro->nilai6_pem2 + $sempro->nilaisempro->nilai7_pem2;

        $ratarata = number_format(($nilaiPenguji1 + $nilaiPenguji2 + $nilaiPenguji3 + $nilaiPem1 + $nilaiPem2) / 5, 2);

        if (!$nilaiPem1 || !$nilaiPem2 || !$nilaiPenguji1 || !$nilaiPenguji2 || !$nilaiPenguji3) {
            $sempro->update([
                'status' => 'penilaian',
            ]);
        } elseif ($ratarata >= 65) {
            $sempro->update([
                'status' => 'lulus',
            ]);
        } else {
            $sempro->update([
                'status' => 'tidak lulus',
            ]);
        }

        Alert::success('Berhasil', 'Input Nilai Seminar Proposal');

        return redirect('/nilai/sempro');
    }
}
