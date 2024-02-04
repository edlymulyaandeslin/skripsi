<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('manajemen.mahasiswa.index', [
            'title' => 'E - Skripsi | Mahasiswa',
            'mahasiswas' => User::where('role_id', 4)->latest()->get()
        ]);
    }

    public function create()
    {
        return view('manajemen.mahasiswa.create', [
            'title' => 'E - Skripsi | Tambah Mahasiswa'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim_or_nidn' => 'required|min:5|max:8',
            'name' => 'required|max:255',
            'password' => 'required|min:8|max:255'
        ], [
            'nim_or_nidn.required' => 'The nim field is required.',
            'nim_or_nidn.min' => 'The nim field must be at least 5 characters.',
            'nim_or_nidn.max' => 'The nim field must not be greater than 8 characters.',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);
        $validateData['role_id'] = 4;

        User::create($validateData);

        return redirect('/manajemen/mahasiswa')->with('success', 'Mahasiswa baru ditambahkan');
    }

    public function show($id)
    {
        $mahasiswa = User::with(['judul', 'judul.pembimbing1', 'judul.pembimbing2', 'judul.sempro', 'judul.kompre'])->find($id);

        return response()->json($mahasiswa);
    }

    public function edit($id)
    {
        return view('manajemen.mahasiswa.edit', [
            'title' => 'Mahasiswa | Edit',
            'mahasiswa' => User::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nim_or_nidn' => 'required|min:5|max:8',
            'name' => 'required|max:255',
        ];

        $customMessage = [
            'nim_or_nidn.required' => 'The nim field is required.',
            'nim_or_nidn.min' => 'The nim field min 5.',
            'nim_or_nidn.max' => 'The nim field max 8.',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8|max:255';
        }

        $validateData = $request->validate($rules, $customMessage);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($validateData['password']);
        }

        User::where('id', $id)->update($validateData);

        return redirect('/manajemen/mahasiswa')->with('success', 'Mahasiswa berhasil di update');
    }
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/manajemen/mahasiswa')->with('success', 'Mahasiswa berhasil di hapus');
    }
}
