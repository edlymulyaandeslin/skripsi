<?php

namespace App\Http\Controllers;

use App\Models\Kompre;
use App\Models\Logbook;
use App\Models\Sempro;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class CetakController extends Controller
{
    // start Cetak bimbingan form
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
    // public function beritaAcaraSempro(Sempro $sempro)
    // {
    //     $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3']);

    //     return view('cetak.berita-acara-sempro', [
    //         'title' => 'SEMINAR PROPOSAL',
    //         'sempro' => $sempro,
    //         'kaprodi' => User::where('role_id', 3)->where('posisi','kaprodi')->get()
    //     ]);
    // }
    public function cetak_bAcaraSempro(Sempro $sempro)
    {
        $sempro->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaisempro']);

        $data = [
            'title' => 'SEMINAR PROPOSAL',
            'sempro' => $sempro,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get()
        ];

        $pdf = Pdf::loadView('cetak.berita-acara-sempro', $data);
        return $pdf->download('berita-acara-seminar-proposal.pdf');
    }
    //  end Cetak Berita Acara Sempro


    public function cetak_bAcaraKompre(Kompre $kompre)
    {
        $kompre->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaikompre']);

        $data = [
            'title' => 'SEMINAR KOMPREHENSIF',
            'kompre' => $kompre,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get()
        ];

        $pdf = Pdf::loadView('cetak.berita-acara-kompre', $data);
        return $pdf->download('berita-acara-seminar-komprehensif.pdf');
    }
    //  end Cetak Berita Acara Kompre


    // list mahasiswa sempro
    public function cetak_listMahasiswaSempro()
    {
        $sempros = Sempro::with('judul.mahasiswa')->whereNotIn('status', ['diajukan', 'perbaikan'])->latest()->get();

        if ($sempros->count() == 0) {
            Alert::error('Opsss', 'Maaf Belum Ada Mahasiswa Yang Seminar Proposal');
            return redirect('/berita-acara/sempro');
        }

        $data = [
            'title' => 'Mahasiswa Seminar Proposal',
            'sempros' => $sempros,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get()
        ];

        $pdf = Pdf::loadView('cetak.list-mahasiswa-sempro', $data);
        return $pdf->download('mahasiswa-seminar-proposal.pdf');
    }

    public function cetak_listMahasiswaKompre()
    {
        $kompres = Kompre::with('judul.mahasiswa')->whereNotIn('status', ['diajukan', 'perbaikan'])->latest()->get();

        if ($kompres->count() == 0) {
            Alert::error('Opsss', 'Maaf Belum Ada Mahasiswa Yang Seminar Komprehensif');
            return redirect('/berita-acara/kompre');
        }

        $data = [
            'title' => 'Mahasiswa Seminar Komprehensif',
            'kompres' => $kompres,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get()
        ];

        $pdf = Pdf::loadView('cetak.list-mahasiswa-kompre', $data);
        return $pdf->download('mahasiswa-seminar-komprehensif.pdf');
    }
}
