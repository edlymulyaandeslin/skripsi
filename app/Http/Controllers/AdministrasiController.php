<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Kompre;
use App\Models\Sempro;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdministrasiController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Administrasi::class);

        $dosens = "";

        if (auth()->user()->role_id == 3) {
            $dosens = User::where('role_id', 3)->where('id', auth()->user()->id)->latest()->filter(request(['search']))->paginate(10)->withQueryString();
        } else {
            $dosens = User::where('role_id', 3)->latest()->filter(request(['search']))->paginate(10)->withQueryString();
        }

        $sempros = Sempro::with(['judul'])->where('status', 'lulus')->latest()->get();
        $kompres = Kompre::with(['judul'])->where('status', 'lulus')->latest()->get();
        $administrasi = Administrasi::latest()->get();

        return view('administrasi.index', [
            'title' => 'Administrasi',
            'dosens' => $dosens,
            'sempros' => $sempros,
            'kompres' => $kompres,
            'administrasi' => $administrasi
        ]);
    }

    public function create($id, $total)
    {
        $adm = Administrasi::where('dosen_id', $id)->get();
        $totalBayar = 0;
        foreach ($adm as $a) {
            $totalBayar += $a->bayar;
        }

        if ($total == $totalBayar) {
            Alert::warning('Warning', 'Tidak ada yang perlu dibayar lagi');
            return redirect('/adm-seminar/' . $id . '/pay/' . $total);
        }

        $dosen  = User::find($id);
        return view('administrasi.create', [
            'title' => 'Payment | Input',
            'dosen' => $dosen,
            'totalbayar' => $total
        ]);
    }

    public function store(Request $request, $id, $total)
    {
        $administrasi = Administrasi::where('dosen_id', $id)->get();
        $totalBayar = 0;
        foreach ($administrasi as $a) {
            $totalBayar += $a->bayar;
        }

        $validateData = $request->validate([
            'bayar' => 'required|numeric|min:10000|max:' . $total - $totalBayar,
        ]);
        $validateData['dosen_id'] = $id;

        Administrasi::create($validateData);

        Alert::success('Berhasil', 'Pembayaran Berhasil');

        return redirect('/adm-seminar/' . $id . '/pay/' . $total);
    }

    public function edit($id, $total)
    {
        $dosen = User::find($id);

        $administrasi = Administrasi::where('dosen_id', $id)
            ->latest()->paginate(10);

        return view('administrasi.edit', [
            'title' => 'Administrasi | Payment',
            'dosen' => $dosen,
            'administrasi' => $administrasi,
            'totalbayar' => $total
        ]);
    }

    public function destroy($id)
    {
        Administrasi::destroy($id);

        Alert::success('Berhasil', 'Pembayaran Telah Dihapus');

        return back();
    }
}
