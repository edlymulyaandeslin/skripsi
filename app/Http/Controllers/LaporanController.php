<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $mahasiswas = User::with(['judul.sempro', 'judul.kompre'])
            ->where('role_id', 4)->get();
        return view('laporan.index', [
            'title' => 'E - Skripsi | Laporan',
            'mahasiswas' => $mahasiswas
        ]);
    }

    public function show(User $user)
    {
        $mahasiswa = $user->load(['judul.pembimbing1', 'judul.pembimbing2', 'judul.sempro', 'judul.kompre']);

        return response()->json($mahasiswa);
    }
}
