<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaSkripsiController extends Controller
{
    public function bimbingan()
    {
        $this->authorize('dosen');

        $mahasiswas = User::with(['judul'])
            ->whereHas('judul', function ($query) {
                $query->where('pembimbing1_id', auth()->user()->id)
                    ->orWhere('pembimbing2_id', auth()->user()->id);
            })
            ->where('role_id', 4)->get();

        return view('manajemen.mahasiswa.mahasiswa-bimbingan', [
            'title' => 'E - Skripsi | Mahasiswa Bimbingan',
            'mahasiswas' => $mahasiswas
        ]);
    }

    public function sempro()
    {
        $this->authorize('dosen');

        $mahasiswas = User::with(['judul.sempro'])
            ->whereHas('judul.sempro', function ($query) {
                $query->where('penguji1_id', auth()->user()->id)
                    ->orWhere('penguji2_id', auth()->user()->id)
                    ->orWhere('penguji3_id', auth()->user()->id);
            })
            ->where('role_id', 4)->get();

        return view('manajemen.mahasiswa.mahasiswa-uji-sempro', [
            'title' => 'E - Skripsi | Uji Mahasiswa',
            'mahasiswas' => $mahasiswas
        ]);
    }
    public function kompre()
    {
        $this->authorize('dosen');

        $mahasiswas = User::with(['judul.kompre'])
            ->whereHas('judul.kompre', function ($query) {
                $query->where('penguji1_id', auth()->user()->id)
                    ->orWhere('penguji2_id', auth()->user()->id)
                    ->orWhere('penguji3_id', auth()->user()->id);
            })
            ->where('role_id', 4)->get();

        return view('manajemen.mahasiswa.mahasiswa-uji-kompre', [
            'title' => 'E - Skripsi | Uji Mahasiswa',
            'mahasiswas' => $mahasiswas
        ]);
    }

    public function show(User $user)
    {
        // $mahasiswa = $user->with(['judul.pembimbing1', 'judul.pembimbing2', 'judul.sempro', 'judul.kompre'])->find($id);
        $mahasiswa = $user->load(['judul.pembimbing1', 'judul.pembimbing2', 'judul.sempro', 'judul.kompre']);

        return response()->json($mahasiswa);
    }
}
