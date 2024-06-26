<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    public function index()

    {
        // confirm delete judul
        $title = 'Hapus Dosen!';
        $text = "Kamu yakin ingin menghapus?";
        confirmDelete($title, $text);

        return view('manajemen.dosen.index', [
            'title' => 'E - Skripsi | Dosen',
            'dosens' => User::where('role_id', 3)->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('manajemen.dosen.create', [
            'title' => 'E - Skripsi | Tambah Dosen'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim_or_nidn' => 'required|min:5|max:13|unique:users,nim_or_nidn',
            'name' => 'required|max:255',
            'password' => 'required|min:8|max:255'
        ], [
            'nim_or_nidn.required' => 'The nidn field is required.',
            'nim_or_nidn.unique' => 'The nidn has already been taken.',
            'nim_or_nidn.min' => 'The nidn field must be at least 5 characters.',
            'nim_or_nidn.max' => 'The nidn field must not be greater than 13 characters.',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $validateData['role_id'] = 3;

        User::create($validateData);

        Alert::success('Berhasil', 'Dosen Telah Ditambahkan');

        return redirect(route('dosen.index'));
    }

    public function show(User $user, $id)
    {
        $dosen = $user->with(['judul', 'judul.pembimbing1', 'judul.pembimbing2', 'judul.sempro', 'judul.kompre'])->find($id);

        return response()->json($dosen);
    }

    public function edit(User $user, $id)
    {
        return view('manajemen.dosen.edit', [
            'title' => 'dosen | Edit',
            'dosen' => $user->find($id)
        ]);
    }

    public function update(Request $request, User $user, $id)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        $customMessage = [];

        if ($request->filled('nim_or_nidn')) {
            $rules['nim_or_nidn'] = ['min:5', 'max:13',  Rule::unique('users', 'nim_or_nidn')->ignore($id)];
            $customMessage['nim_or_nidn.unique'] = 'The nidn has already been taken.';
            $customMessage['nim_or_nidn.min'] = 'The nidn field min 5.';
            $customMessage['nim_or_nidn.max'] = 'The nidn field max 13.';
        }

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8|max:255';
        }

        $validateData = $request->validate($rules, $customMessage);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($validateData['password']);
        }

        $user->where('id', $id)->update($validateData);

        Alert::success('Berhasil', 'Data Dosen Diperbarui');

        return redirect(route('dosen.index'));
    }
    public function destroy(User $user, $id)
    {
        $user->destroy($id);

        Alert::success('Berhasil', 'Dosen Telah Dihapus');

        return redirect(route('dosen.index'));
    }
}
