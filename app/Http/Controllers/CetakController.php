<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kompre;
use App\Models\Logbook;
use App\Models\Sempro;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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


    // start Cetak Berita Acara Sempro
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


    // start Cetak Berita Acara Kompre
    public function cetak_bAcaraKompre(Kompre $kompre)
    {
        $kompre->load(['judul.mahasiswa', 'judul.pembimbing1', 'judul.pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'nilaikompre']);

        // return view('cetak.berita-acara-kompre', [
        //     'title' => 'SEMINAR KOMPREHENSIF',
        //     'kompre' => $kompre,
        //     'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get(),
        //     'bobot' => Bobot::first()
        // ]);

        $data = [
            'title' => 'SEMINAR KOMPREHENSIF',
            'kompre' => $kompre,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get(),
            'bobot' => Bobot::first()
        ];

        $pdf = Pdf::loadView('cetak.berita-acara-kompre', $data);
        return $pdf->download('berita-acara-seminar-komprehensif.pdf');
    }
    //  end Cetak Berita Acara Kompre


    // list mahasiswa seminar
    public function cetak_listMahasiswaSeminar()
    {
        $users = User::with(['judul.pembimbing1', 'judul.pembimbing2', 'judul.sempro.penguji1', 'judul.sempro.penguji2', 'judul.sempro.penguji3', 'judul.kompre.penguji1', 'judul.kompre.penguji2', 'judul.kompre.penguji3'])
            ->where(function ($query) {
                $query->orWhereHas('judul.sempro', function ($query) {
                    $query->where('status', 'diterima');
                })
                    ->orWhereHas('judul.kompre', function ($query) {
                        $query->where('status', 'diterima');
                    });
            })->where('role_id', 4)
            ->latest()->get();

        if ($users->count() == 0) {
            Alert::error('Opsss', 'Maaf Belum Ada Mahasiswa Yang Seminar');
            return back();
        }

        $data = [
            'title' => 'Mahasiswa Seminar',
            'users' => $users,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get()
        ];

        $pdf = Pdf::loadView('cetak.list-mahasiswa-seminar', $data)->setPaper('legal', 'landscape');
        return $pdf->download('mahasiswa-seminar.pdf');
    }
    // end list mahasiswa seminar


    // list mahasiswa lulus sempro
    public function cetak_lulusSempro()
    {
        $sempros = Sempro::with(['judul.mahasiswa', 'nilaisempro'])->where('status', 'lulus')->latest()->get();

        if ($sempros->count() == 0) {
            Alert::error('Opsss', 'Maaf Belum Ada Mahasiswa Yang Lulus Seminar Proposal');
            return back();
        }

        $data = [
            'title' => 'Lulus Sempro',
            'sempros' => $sempros,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get()
        ];

        $pdf = Pdf::loadView('cetak.list-lulus-sempro', $data);
        return $pdf->download('mahasiswa-lulus-sempro.pdf');
    }
    // end list mahasiswa lulus sempro


    // list mahasiswa lulus kompre
    public function cetak_lulusKompre()
    {
        $kompres = Kompre::with(['judul.mahasiswa', 'nilaikompre'])->where('status', 'lulus')->latest()->get();

        if ($kompres->count() == 0) {
            Alert::error('Opsss', 'Maaf Belum Ada Mahasiswa Yang Lulus Seminar Komprehensif');
            return back();
        }

        $data = [
            'title' => 'Lulus Kompre',
            'kompres' => $kompres,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get()
        ];

        $pdf = Pdf::loadView('cetak.list-lulus-kompre', $data);
        return $pdf->download('mahasiswa-lulus-kompre.pdf');
    }
    // end list mahasiswa lulus kompre

    // list mahasiswa lulus yudisium
    public function cetak_yudisium(Request $request)
    {
        $tanggalAwal = $request->tanggalAwal;
        $tanggalAkhir = $request->tanggalAkhir;

        if ($tanggalAwal > $tanggalAkhir) {
            Alert::warning('Warning', 'Tanggal Periode Awal Tidak Boleh Lebih Besar Daripada Tanggal Periode Akhir');
            return back();
        }

        $users = User::with([
            'judul.pembimbing1', 'judul.pembimbing2',
            'judul.sempro.penguji1', 'judul.sempro.penguji2', 'judul.sempro.penguji3',
            'judul.kompre.penguji1', 'judul.kompre.penguji2', 'judul.kompre.penguji3'
        ])
            ->where(function ($query) use ($tanggalAwal, $tanggalAkhir) {
                $query->whereHas('judul.sempro', function ($query) {
                    $query->where('status', 'lulus');
                })
                    ->whereHas('judul.kompre', function ($query) use ($tanggalAwal, $tanggalAkhir) {
                        $query->where('status', 'lulus')
                            ->whereBetween('updated_at', [$tanggalAwal, $tanggalAkhir]);
                    });
            })->where('role_id', 4)
            ->latest()
            ->get();

        if ($users->count() == 0) {
            Alert::info('Info', 'Tidak Ada Mahasiswa Pada Tanggal Periode Yang Di Pilih');
            return back();
        }

        $data = [
            'title' => 'Yudisium',
            'users' => $users,
            'kaprodi' => User::where('role_id', 3)->where('posisi', 'kaprodi')->get()
        ];

        $pdf = Pdf::loadView('cetak.list-lulus-yudisium', $data);
        return $pdf->download('mahasiswa-yudisium.pdf');
    }
    // end list mahasiswa lulus yudisium
}
