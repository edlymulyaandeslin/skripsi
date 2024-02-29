<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
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
            $bobot = Bobot::first();

            $kompres = Kompre::with('judul.mahasiswa', 'nilaikompre')
                ->whereNotIn('status', ['diajukan', 'perbaikan', 'lulus'])
                ->latest()
                ->paginate(10);

            return view('kompre.nilai.index', [
                'title' => 'Seminar Komprehensif | Penilaian',
                'kompres' => $kompres,
                'bobot' => $bobot
            ]);
        }

        // dosen
        if (auth()->user()->role_id === 3) {
            $bobot = Bobot::first();

            $kompres = Kompre::with('judul.mahasiswa', 'nilaikompre')
                ->whereNotIn('status', ['diajukan', 'perbaikan', 'lulus'])
                ->whereHas('judul', function ($query) {
                    $query->orWhere('pembimbing1_id', auth()->user()->id)
                        ->orWhere('pembimbing2_id', auth()->user()->id);
                })->orWhere(function ($query) {
                    $query->where('penguji1_id', auth()->user()->id)
                        ->where('penguji2_id', auth()->user()->id)
                        ->where('penguji3_id', auth()->user()->id);
                })
                ->latest()
                ->paginate(10);

            return view('kompre.nilai.index', [
                'title' => 'Komprehensif | Penilaian',
                'kompres' => $kompres,
                'bobot' => $bobot

            ]);
        }

        // mahasiswa
        $bobot = Bobot::first();

        $kompres = Kompre::with('judul.mahasiswa', 'nilaikompre')
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->whereNotIn('status', ['diajukan', 'perbaikan'])
            ->latest()
            ->paginate(10);

        if ($kompres->count() == 0) {
            Alert::info('Info', 'Kamu Belum Mengajukan Seminar Komprehensif');
            return redirect()->route('kompre.create');
        }

        return view('kompre.nilai.index', [
            'title' => 'Komprehensif | Penilaian',
            'kompres' => $kompres,
            'bobot' => $bobot

        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'kompre_id' => 'required',
        ];

        $customMessage = [
            'kompre_id.required' => 'Kompre Tidak Boleh Kosong',
        ];

        // input nilai form penguji 1
        if ($request->filled('nilai1_peng1')) {
            $rules['nilai1_peng1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_peng1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_peng1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_peng1')) {
            $rules['nilai2_peng1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_peng1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_peng1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_peng1')) {
            $rules['nilai3_peng1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_peng1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_peng1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_peng1')) {
            $rules['nilai4_peng1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_peng1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_peng1.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        // input nilai form penguji 2
        if ($request->filled('nilai1_peng2')) {
            $rules['nilai1_peng2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_peng2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_peng2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_peng2')) {
            $rules['nilai2_peng2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_peng2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_peng2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_peng2')) {
            $rules['nilai3_peng2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_peng2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_peng2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_peng2')) {
            $rules['nilai4_peng2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_peng2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_peng2.max'] = 'Nilai tidak boleh lebih dari 100';
        }


        // input nilai form penguji 3
        if ($request->filled('nilai1_peng3')) {
            $rules['nilai1_peng3'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_peng3.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_peng3.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_peng3')) {
            $rules['nilai2_peng3'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_peng3.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_peng3.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_peng3')) {
            $rules['nilai3_peng3'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_peng3.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_peng3.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_peng3')) {
            $rules['nilai4_peng3'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_peng3.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_peng3.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        // input nilai form pembimbing 1
        if ($request->filled('nilai1_pem1')) {
            $rules['nilai1_pem1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_pem1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_pem1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_pem1')) {
            $rules['nilai2_pem1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_pem1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_pem1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_pem1')) {
            $rules['nilai3_pem1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_pem1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_pem1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_pem1')) {
            $rules['nilai4_pem1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_pem1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_pem1.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        // input nilai form pembimbing 2
        if ($request->filled('nilai1_pem2')) {
            $rules['nilai1_pem2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_pem2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_pem2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_pem2')) {
            $rules['nilai2_pem2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_pem2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_pem2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_pem2')) {
            $rules['nilai3_pem2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_pem2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_pem2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_pem2')) {
            $rules['nilai4_pem2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_pem2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_pem2.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        $validateData = $request->validate($rules, $customMessage);

        $bobot = Bobot::first();

        if ($request->filled('nilai1_peng1') || $request->filled('nilai2_peng1') || $request->filled('nilai3_peng1') || $request->filled('nilai4_peng1')) {
            $validateData['nilai1_peng1'] = $validateData['nilai1_peng1'] * $bobot->bobot1;
            $validateData['nilai2_peng1'] = $validateData['nilai2_peng1'] * $bobot->bobot2;
            $validateData['nilai3_peng1'] = $validateData['nilai3_peng1'] * $bobot->bobot3;
            $validateData['nilai4_peng1'] = $validateData['nilai4_peng1'] * $bobot->bobot4;
        }
        if ($request->filled('nilai1_peng2') || $request->filled('nilai2_peng2') || $request->filled('nilai3_peng2') || $request->filled('nilai4_peng2')) {
            $validateData['nilai1_peng2'] = $validateData['nilai1_peng2'] * $bobot->bobot1;
            $validateData['nilai2_peng2'] = $validateData['nilai2_peng2'] * $bobot->bobot2;
            $validateData['nilai3_peng2'] = $validateData['nilai3_peng2'] * $bobot->bobot3;
            $validateData['nilai4_peng2'] = $validateData['nilai4_peng2'] * $bobot->bobot4;
        }
        if ($request->filled('nilai1_peng3') || $request->filled('nilai2_peng3') || $request->filled('nilai3_peng3') || $request->filled('nilai4_peng3')) {
            $validateData['nilai1_peng3'] = $validateData['nilai1_peng3'] * $bobot->bobot1;
            $validateData['nilai2_peng3'] = $validateData['nilai2_peng3'] * $bobot->bobot2;
            $validateData['nilai3_peng3'] = $validateData['nilai3_peng3'] * $bobot->bobot3;
            $validateData['nilai4_peng3'] = $validateData['nilai4_peng3'] * $bobot->bobot4;
        }
        if ($request->filled('nilai1_pem1') || $request->filled('nilai2_pem1') || $request->filled('nilai3_pem1') || $request->filled('nilai4_pem1')) {
            $validateData['nilai1_pem1'] = $validateData['nilai1_pem1'] * $bobot->bobot1;
            $validateData['nilai2_pem1'] = $validateData['nilai2_pem1'] * $bobot->bobot2;
            $validateData['nilai3_pem1'] = $validateData['nilai3_pem1'] * $bobot->bobot3;
            $validateData['nilai4_pem1'] = $validateData['nilai4_pem1'] * $bobot->bobot4;
        }
        if ($request->filled('nilai1_pem2') || $request->filled('nilai2_pem2') || $request->filled('nilai3_pem2') || $request->filled('nilai4_pem2')) {
            $validateData['nilai1_pem2'] = $validateData['nilai1_pem2'] * $bobot->bobot1;
            $validateData['nilai2_pem2'] = $validateData['nilai2_pem2'] * $bobot->bobot2;
            $validateData['nilai3_pem2'] = $validateData['nilai3_pem2'] * $bobot->bobot3;
            $validateData['nilai4_pem2'] = $validateData['nilai4_pem2'] * $bobot->bobot4;
        }

        NilaiKompre::create($validateData);

        Alert::success('Berhasil', 'Input Nilai Seminar Komprehensif');

        return redirect('/nilai/kompre');
    }


    public function show(Kompre $kompre)
    {
        $kompres = $kompre->load(['judul', 'judul.mahasiswa', 'penguji1', 'penguji2', 'penguji3', 'nilaikompre']);
        $bobot = Bobot::first();

        $data = [
            'kompres' => $kompres,
            'bobot' => $bobot
        ];

        return response()->json($data);
    }


    public function edit(Kompre $kompre, NilaiKompre $nilaikompre)
    {
        // akses sesuai pembimbing dan penguji
        $this->authorize('update', $nilaikompre);

        return view('kompre.nilai.edit', [
            'title' => 'Komprehensif | Input Nilai',
            'kompre' => $kompre->load('judul', 'judul.pembimbing1', 'judul.pembimbing2', 'nilaikompre', 'penguji1', 'penguji2', 'penguji3'),
            'bobots' => Bobot::first(),
        ]);
    }

    public function update(Request $request, $id, NilaiKompre $nilaikompre)
    {
        // akses sesuai pembimbing dan penguji
        $this->authorize('update', $nilaikompre);

        $rules = [
            'kompre_id' => 'required',
        ];

        $customMessage = [
            'kompre_id.required' => 'Kompre Tidak Boleh Kosong',
        ];

        // input nilai form penguji 1
        if ($request->filled('nilai1_peng1')) {
            $rules['nilai1_peng1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_peng1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_peng1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_peng1')) {
            $rules['nilai2_peng1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_peng1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_peng1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_peng1')) {
            $rules['nilai3_peng1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_peng1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_peng1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_peng1')) {
            $rules['nilai4_peng1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_peng1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_peng1.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        // input nilai form penguji 2
        if ($request->filled('nilai1_peng2')) {
            $rules['nilai1_peng2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_peng2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_peng2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_peng2')) {
            $rules['nilai2_peng2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_peng2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_peng2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_peng2')) {
            $rules['nilai3_peng2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_peng2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_peng2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_peng2')) {
            $rules['nilai4_peng2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_peng2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_peng2.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        // input nilai form penguji 3
        if ($request->filled('nilai1_peng3')) {
            $rules['nilai1_peng3'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_peng3.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_peng3.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_peng3')) {
            $rules['nilai2_peng3'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_peng3.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_peng3.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_peng3')) {
            $rules['nilai3_peng3'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_peng3.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_peng3.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_peng3')) {
            $rules['nilai4_peng3'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_peng3.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_peng3.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        // input nilai form pembimbing 1
        if ($request->filled('nilai1_pem1')) {
            $rules['nilai1_pem1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_pem1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_pem1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_pem1')) {
            $rules['nilai2_pem1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_pem1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_pem1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_pem1')) {
            $rules['nilai3_pem1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_pem1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_pem1.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_pem1')) {
            $rules['nilai4_pem1'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_pem1.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_pem1.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        // input nilai form pembimbing 2
        if ($request->filled('nilai1_pem2')) {
            $rules['nilai1_pem2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai1_pem2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai1_pem2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai2_pem2')) {
            $rules['nilai2_pem2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai2_pem2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai2_pem2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai3_pem2')) {
            $rules['nilai3_pem2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai3_pem2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai3_pem2.max'] = 'Nilai tidak boleh lebih dari 100';
        }
        if ($request->filled('nilai4_pem2')) {
            $rules['nilai4_pem2'] = 'required|numeric|min:10|max:100';
            $customMessage['nilai4_pem2.min'] = 'Nilai tidak boleh kurang dari 10';
            $customMessage['nilai4_pem2.max'] = 'Nilai tidak boleh lebih dari 100';
        }

        $validateData = $request->validate($rules, $customMessage);

        $bobot = Bobot::first();

        if ($request->filled('nilai1_peng1') || $request->filled('nilai2_peng1') || $request->filled('nilai3_peng1') || $request->filled('nilai4_peng1')) {
            $validateData['nilai1_peng1'] = $validateData['nilai1_peng1'] * $bobot->bobot1;
            $validateData['nilai2_peng1'] = $validateData['nilai2_peng1'] * $bobot->bobot2;
            $validateData['nilai3_peng1'] = $validateData['nilai3_peng1'] * $bobot->bobot3;
            $validateData['nilai4_peng1'] = $validateData['nilai4_peng1'] * $bobot->bobot4;
        }
        if ($request->filled('nilai1_peng2') || $request->filled('nilai2_peng2') || $request->filled('nilai3_peng2') || $request->filled('nilai4_peng2')) {
            $validateData['nilai1_peng2'] = $validateData['nilai1_peng2'] * $bobot->bobot1;
            $validateData['nilai2_peng2'] = $validateData['nilai2_peng2'] * $bobot->bobot2;
            $validateData['nilai3_peng2'] = $validateData['nilai3_peng2'] * $bobot->bobot3;
            $validateData['nilai4_peng2'] = $validateData['nilai4_peng2'] * $bobot->bobot4;
        }
        if ($request->filled('nilai1_peng3') || $request->filled('nilai2_peng3') || $request->filled('nilai3_peng3') || $request->filled('nilai4_peng3')) {
            $validateData['nilai1_peng3'] = $validateData['nilai1_peng3'] * $bobot->bobot1;
            $validateData['nilai2_peng3'] = $validateData['nilai2_peng3'] * $bobot->bobot2;
            $validateData['nilai3_peng3'] = $validateData['nilai3_peng3'] * $bobot->bobot3;
            $validateData['nilai4_peng3'] = $validateData['nilai4_peng3'] * $bobot->bobot4;
        }
        if ($request->filled('nilai1_pem1') || $request->filled('nilai2_pem1') || $request->filled('nilai3_pem1') || $request->filled('nilai4_pem1')) {
            $validateData['nilai1_pem1'] = $validateData['nilai1_pem1'] * $bobot->bobot1;
            $validateData['nilai2_pem1'] = $validateData['nilai2_pem1'] * $bobot->bobot2;
            $validateData['nilai3_pem1'] = $validateData['nilai3_pem1'] * $bobot->bobot3;
            $validateData['nilai4_pem1'] = $validateData['nilai4_pem1'] * $bobot->bobot4;
        }
        if ($request->filled('nilai1_pem2') || $request->filled('nilai2_pem2') || $request->filled('nilai3_pem2') || $request->filled('nilai4_pem2')) {
            $validateData['nilai1_pem2'] = $validateData['nilai1_pem2'] * $bobot->bobot1;
            $validateData['nilai2_pem2'] = $validateData['nilai2_pem2'] * $bobot->bobot2;
            $validateData['nilai3_pem2'] = $validateData['nilai3_pem2'] * $bobot->bobot3;
            $validateData['nilai4_pem2'] = $validateData['nilai4_pem2'] * $bobot->bobot4;
        }

        NilaiKompre::where('id', $id)->update($validateData);

        $kompre = Kompre::find($validateData['kompre_id']);

        $nilaiPenguji1 = ($kompre->nilaikompre->nilai1_peng1 + $kompre->nilaikompre->nilai2_peng1 + $kompre->nilaikompre->nilai3_peng1 + $kompre->nilaikompre->nilai4_peng1) / 5;

        $nilaiPenguji2 = ($kompre->nilaikompre->nilai1_peng2 + $kompre->nilaikompre->nilai2_peng2 + $kompre->nilaikompre->nilai3_peng2 + $kompre->nilaikompre->nilai4_peng2) / 5;

        $nilaiPenguji3 = ($kompre->nilaikompre->nilai1_peng3 + $kompre->nilaikompre->nilai2_peng3 + $kompre->nilaikompre->nilai3_peng3 + $kompre->nilaikompre->nilai4_peng3) / 5;

        $nilaiPem1 = ($kompre->nilaikompre->nilai1_pem1 + $kompre->nilaikompre->nilai2_pem1 + $kompre->nilaikompre->nilai3_pem1 + $kompre->nilaikompre->nilai4_pem1) / 5;

        $nilaiPem2 = ($kompre->nilaikompre->nilai1_pem2 + $kompre->nilaikompre->nilai2_pem2 + $kompre->nilaikompre->nilai3_pem2 + $kompre->nilaikompre->nilai4_pem2) / 5;

        $ratarata = number_format(($nilaiPenguji1 + $nilaiPenguji2 + $nilaiPenguji3 + $nilaiPem1 + $nilaiPem2) / 5, 2);

        if (!$nilaiPem1 || !$nilaiPem2 || !$nilaiPenguji1 || !$nilaiPenguji2 || !$nilaiPenguji3) {
            $kompre->update([
                'status' => 'penilaian',
            ]);
        } else if ($ratarata >= 65) {
            $kompre->update([
                'status' => 'lulus',
            ]);
        } else {
            $kompre->update([
                'status' => 'tidak lulus',
            ]);
        }

        Alert::success('Berhasil', 'Input Nilai Seminar Komprehensif');

        return redirect('/nilai/kompre');
    }
}
