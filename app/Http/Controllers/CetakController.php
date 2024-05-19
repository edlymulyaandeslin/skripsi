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
    public function cetak_lulusSempro(Request $request)
    {
        $tanggalAwal = $request->tanggalAwal;
        $tanggalAkhir = $request->tanggalAkhir;

        if ($tanggalAwal > $tanggalAkhir) {
            Alert::warning('Warning', 'Tanggal Awal Tidak Boleh Lebih Besar Daripada Tanggal Akhir');
            return back();
        }

        $sempros = Sempro::with(['judul.mahasiswa', 'nilaisempro'])
            ->where('status', 'lulus')
            ->whereBetween('tanggal_seminar', [$tanggalAwal, $tanggalAkhir])
            ->latest()->get();

        if ($sempros->count() == 0) {
            Alert::info('Info', 'Tidak Ada Mahasiswa Pada Tanggal Yang Di Pilih');
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
    public function cetak_lulusKompre(Request $request)
    {
        $tanggalAwal = $request->tanggalAwal;
        $tanggalAkhir = $request->tanggalAkhir;

        if ($tanggalAwal > $tanggalAkhir) {
            Alert::warning('Warning', 'Tanggal Awal Tidak Boleh Lebih Besar Daripada Tanggal Akhir');
            return back();
        }

        $kompres = Kompre::with(['judul.mahasiswa', 'nilaikompre'])
            ->where('status', 'lulus')
            ->whereBetween('tanggal_seminar', [$tanggalAwal, $tanggalAkhir])
            ->latest()->get();

        if ($kompres->count() == 0) {
            Alert::info('Info', 'Tidak Ada Mahasiswa Pada Tanggal Yang Di Pilih');
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
            Alert::warning('Warning', 'Tanggal Awal Tidak Boleh Lebih Besar Daripada Tanggal Akhir');
            return back();
        }

        $users = User::with([
            'judul.kompre'
        ])
            ->where('role_id', 4)
            ->where('status', 'lulus')
            ->where(function ($query) use ($tanggalAwal, $tanggalAkhir) {
                $query->whereHas('judul.kompre', function ($query) use ($tanggalAwal, $tanggalAkhir) {
                    $query->whereBetween('updated_at', [$tanggalAwal, $tanggalAkhir]);
                });
            })
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

    // start list judul acc
    public function cetak_listJudul()
    {
        $listJudul = session('list-judul');

        if ($listJudul->count() == 0) {
            Alert::info('Info', 'Tidak ada rekap judul pada periode ini');
            return back();
        }

        $data = [
            'title' => 'Rekap Judul',
            'juduls' => $listJudul,
        ];

        $pdf = Pdf::loadView('cetak.list-rekap-judul', $data);
        return $pdf->download('rekap-judul.pdf');
    }
    // end list judul acc

}
