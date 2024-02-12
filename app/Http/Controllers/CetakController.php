<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Sempro;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CetakController extends Controller
{
    // Cetak bimbingan form
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

    // Cetak formulir pendaftaran seminar
    public function sempro()
    {
        $sempro = Sempro::with(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->first();

        return view('cetak.form-sempro', [
            'title' => 'Form Seminar Proposal',
            'sempro' => $sempro,
            'admin' => User::where('role_id', '1')->get()
        ]);
    }
    public function cetak_fSeminar()
    {
        $sempro = Sempro::with(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3'])
            ->whereHas('judul', function ($query) {
                $query->where('mahasiswa_id', auth()->user()->id);
            })
            ->first();

        $data = [
            'title' => 'Form Seminar Proposal',
            'sempro' => $sempro,
            'admin' => User::where('role_id', '1')->get()
        ];

        $pdf = Pdf::loadView('cetak.form-sempro', $data);
        return $pdf->download('form-seminar-proposal.pdf');
    }

    // Cetak Berita Acara
    public function beritaAcara(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3']);

        return view('cetak.berita-acara', [
            'title' => 'SEMINAR PROPOSAL',
            'sempro' => $sempro,
        ]);
    }
    public function cetak_bAcara(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3']);

        $data = [
            'title' => 'SEMINAR PROPOSAL',
            'sempro' => $sempro,
        ];

        $pdf = Pdf::loadView('cetak.berita-acara', $data);
        return $pdf->download('berita-acara-seminar-proposal.pdf');
    }

    // Cetak Berita Acara
    public function nilaiSempro(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaisempro']);

        return view('cetak.nilai-sempro', [
            'title' => 'PENILAIAN SEMINAR PROPOSAL',
            'sempro' => $sempro,
            'admin' => User::where('role_id', '1')->get()
        ]);
    }
    public function cetak_nSempro(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaisempro']);

        $data = [
            'title' => 'PENILAIAN SEMINAR PROPOSAL',
            'sempro' => $sempro,
            'admin' => User::where('role_id', '1')->get()
        ];

        $pdf = Pdf::loadView('cetak.nilai-sempro', $data);
        return $pdf->download('nilai-seminar-proposal.pdf');
    }
}
