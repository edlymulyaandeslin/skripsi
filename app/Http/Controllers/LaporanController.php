<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\Kompre;
use App\Models\Sempro;
use App\Models\User;

class LaporanController extends Controller
{
    public function rekapJudul()
    {

        $judulAccSess = Judul::with('mahasiswa')->where('status', 'diterima')->filter(request(['search']))->latest()->get();

        session(['list-judul' => $judulAccSess]);

        $judulAcc = Judul::with('mahasiswa')->where('status', 'diterima')->filter(request(['search']))->latest()->paginate(10)->withQueryString();

        return view('report.rekap-judul', [
            'title' => 'E - Skripsi | Rekap Judul',
            'juduls' => $judulAcc
        ]);
    }

    public function seminar()
    {
        $users = User::with([
            'judul.pembimbing1', 'judul.pembimbing2',
            'judul.sempro.penguji1', 'judul.sempro.penguji2', 'judul.sempro.penguji3',
            'judul.kompre.penguji1', 'judul.kompre.penguji2', 'judul.kompre.penguji3'
        ])->where(function ($query) {
            $query->orWhereHas('judul.sempro', function ($query) {
                $query->whereIn('status', ['diterima', 'penilaian']);
            })->orWhereHas('judul.kompre', function ($query) {
                $query->whereIn('status', ['diterima', 'penilaian']);
            });
        })->where('role_id', 4)
            ->whereHas('judul', function ($query) {
                $query->where('status', 'diterima');
            })
            ->latest()
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        return view('report.seminar', [
            'title' => 'E - Skripsi | Seminar',
            'users' => $users
        ]);
    }
    public function lulusSempro()
    {
        $semproLulusSess = Sempro::with(['judul.mahasiswa', 'nilaisempro'])->where('status', 'lulus')
            ->latest()
            ->filter(request(['search']))
            ->get();

        session(['lulus-sempro' => $semproLulusSess]);

        $sempros = Sempro::with(['judul.mahasiswa', 'nilaisempro'])->where('status', 'lulus')
            ->latest()
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        return view('report.lulus-sempro', [
            'title' => 'Lulus | Seminar Proposal',
            'sempros' => $sempros
        ]);
    }
    public function lulusKompre()
    {
        $kompreLulusSess = Kompre::with(['judul.mahasiswa', 'nilaikompre'])->where('status', 'lulus')
            ->latest()
            ->filter(request(['search']))
            ->get();

        session(['lulus-kompre' => $kompreLulusSess]);

        $kompres = Kompre::with(['judul.mahasiswa', 'nilaikompre'])->where('status', 'lulus')
            ->latest()
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        return view('report.lulus-kompre', [
            'title' => 'Lulus | Seminar Komprehensif',
            'kompres' => $kompres
        ]);
    }
    public function yudisium()
    {
        $users = User::with([
            'judul.kompre.nilaikompre', 'judul.sempro.nilaisempro'
        ])->where('role_id', 4)
            ->where('status', 'lulus')
            ->filter(request(['search']))
            ->orderBy('updated_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('report.yudisium', [
            'title' => 'E - Skripsi | Yudisium',
            'users' => $users
        ]);
    }
}
