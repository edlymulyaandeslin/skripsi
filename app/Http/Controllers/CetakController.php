<?php

namespace App\Http\Controllers;

use App\Models\Kompre;
use App\Models\Logbook;
use App\Models\Sempro;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use RealRashid\SweetAlert\Facades\Alert;

class CetakController extends Controller
{
    // start Cetak bimbingan form
    public function bimbingan()
    {
        $logbooks = Logbook::with(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2'])->whereHas('judul', function ($query) {
            $query->where('mahasiswa_id', auth()->user()->id);
        })->latest()->get();

        return view('cetak.bimbingan', [
            'title' => 'bimbingan',
            'logbooks' => $logbooks
        ]);
    }
    public function cetak_bproposal()
    {
        $logbooks = Logbook::with(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })->where('kategori', 'proposal')
            ->get();

        $data = [
            'title' => 'PROPOSAL',
            'logbooks' => $logbooks
        ];

        $pdf = Pdf::loadView('cetak.bimbingan', $data);
        return $pdf->download('lembar-bimbingan-proposal.pdf');
    }
    public function cetak_bkompre()
    {
        $logbooks = Logbook::with(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })->where('kategori', 'komprehensif')
            ->latest()
            ->get();

        $data = [
            'title' => 'KOMPREHENSIF',
            'logbooks' => $logbooks
        ];

        $pdf = Pdf::loadView('cetak.bimbingan', $data);
        return $pdf->download('lembar-bimbingan-komprehensif.pdf');
    }
    // end Cetak bimbingan form

    //  start Cetak Berita Acara Sempro
    public function beritaAcaraSempro(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3']);

        return view('cetak.berita-acara-sempro', [
            'title' => 'SEMINAR PROPOSAL',
            'sempro' => $sempro,
            'admin' => User::where('role_id', 1)->get()
        ]);
    }
    public function cetak_bAcaraSempro(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3']);

        $data = [
            'title' => 'SEMINAR PROPOSAL',
            'sempro' => $sempro,
            'admin' => User::where('role_id', 1)->get()
        ];

        $pdf = Pdf::loadView('cetak.berita-acara-sempro', $data);
        return $pdf->download('berita-acara-seminar-proposal.pdf');
    }
    //  end Cetak Berita Acara Sempro

    // start cetak penilaian sempro
    public function nilaiSempro(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaisempro']);

        return view('cetak.nilai-sempro', [
            'title' => 'PENILAIAN SEMINAR PROPOSAL',
            'sempro' => $sempro,
            'admin' => User::where('role_id', 1)->get()
        ]);
    }
    public function cetak_nSempro(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaisempro']);

        $data = [
            'title' => 'PENILAIAN SEMINAR PROPOSAL',
            'sempro' => $sempro,
            'admin' => User::where('role_id', 1)->get()
        ];

        $pdf = Pdf::loadView('cetak.nilai-sempro', $data);
        return $pdf->download('nilai-seminar-proposal.pdf');
    }
    // end cetak penilaian sempro

    //  start Cetak Berita Acara Kompre
    public function beritaAcaraKompre(Kompre $kompre)
    {
        $kompre->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3']);

        return view('cetak.berita-acara-kompre', [
            'title' => 'SEMINAR KOMPREHENSIF',
            'kompre' => $kompre,
            'admin' => User::where('role_id', 1)->get()
        ]);
    }
    public function cetak_bAcaraKompre(Kompre $kompre)
    {
        $kompre->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3']);

        $data = [
            'title' => 'SEMINAR KOMPREHENSIF',
            'kompre' => $kompre,
            'admin' => User::where('role_id', 1)->get()
        ];

        $pdf = Pdf::loadView('cetak.berita-acara-kompre', $data);
        return $pdf->download('berita-acara-seminar-komprehensif.pdf');
    }
    //  end Cetak Berita Acara Kompre

    // start cetak penilaian Kompre
    public function nilaiKompre(Kompre $kompre)
    {
        $kompre->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaikompre']);

        return view('cetak.nilai-kompre', [
            'title' => 'PENILAIAN SEMINAR KOMPREHENSIF',
            'kompre' => $kompre,
            'admin' => User::where('role_id', 1)->get()
        ]);
    }
    public function cetak_nKompre(Kompre $kompre)
    {
        $kompre->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaikompre']);

        $data = [
            'title' => 'PENILAIAN SEMINAR KOMPREHESIF',
            'kompre' => $kompre,
            'admin' => User::where('role_id', 1)->get()
        ];

        $pdf = Pdf::loadView('cetak.nilai-kompre', $data);
        return $pdf->download('nilai-seminar-komprehensif.pdf');
    }
    // end cetak penilaian kompre

    // list mahasiswa sempro
    public function listMahasiswaSempro()
    {
        $sempros = Sempro::with('judul.mahasiswa')->where('status', 'diterima')->latest()->get();

        if ($sempros->count() == 0) {
            Alert::error('Opsss', 'Maaf Belum Ada Seminar Proposal Yang Diterima');
            return redirect('/sempro');
        }

        $data = [
            'title' => 'Mahasiswa Seminar Komprehensif',
            'sempros' => $sempros,
            'admin' => User::where('role_id', 1)->get()
        ];

        $pdf = Pdf::loadView('cetak.list-mahasiswa-sempro', $data);
        return $pdf->download('mahasiswa-seminar-proposal.pdf');
    }

    public function listMahasiswaKompre()
    {
        $kompres = Kompre::with('judul.mahasiswa')->where('status', 'diterima')->latest()->get();

        $data = [
            'title' => 'Mahasiswa Seminar Komprehensif',
            'kompres' => $kompres,
            'admin' => User::where('role_id', 1)->get()
        ];

        $pdf = Pdf::loadView('cetak.list-mahasiswa-kompre', $data);
        return $pdf->download('mahasiswa-seminar-komprehensif.pdf');
    }
}
