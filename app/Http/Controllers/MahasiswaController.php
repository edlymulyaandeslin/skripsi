<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    public function index()
    {
        // confirm delete judul
        $title = 'Delete Mahasiswa!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

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
            'nim_or_nidn' => 'required|min:5|max:8|unique:users,nim_or_nidn',
            'name' => 'required|max:255',
            'password' => 'required|min:8|max:255'
        ], [
            'nim_or_nidn.required' => 'The nim field is required.',
            'nim_or_nidn.unique' => 'The nim has already been taken.',
            'nim_or_nidn.min' => 'The nim field must be at least 5 characters.',
            'nim_or_nidn.max' => 'The nim field must not be greater than 8 characters.',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $validateData['role_id'] = 4;

        User::create($validateData);

        Alert::success('Success!', 'New students added');

        return redirect('/manajemen/mahasiswa');
    }

    public function show(User $user)
    {
        $mahasiswa = $user->load(['judul', 'judul.pembimbing1', 'judul.pembimbing2', 'judul.sempro', 'judul.kompre']);

        return response()->json($mahasiswa);
    }

    public function edit(User $user)
    {
        return view('manajemen.mahasiswa.edit', [
            'title' => 'Mahasiswa | Edit',
            'mahasiswa' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        $customMessage = [];

        if ($request->filled('nim_or_nidn')) {
            $rules['nim_or_nidn'] = ['min:5', 'max:8',  Rule::unique('users', 'nim_or_nidn')->ignore($user)];
            $customMessage['nim_or_nidn.unique'] = 'The nim has already been taken.';
            $customMessage['nim_or_nidn.min'] = 'The nim field min 5.';
            $customMessage['nim_or_nidn.max'] = 'The nim field max 8.';
        }

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8|max:255';
        }

        $validateData = $request->validate($rules, $customMessage);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($validateData['password']);
        }

        $user->update($validateData);

        Alert::success('Success!', 'Student has successfully updated');

        return redirect('/manajemen/mahasiswa');
    }
    public function destroy(User $user)
    {
        $user->delete();

        Alert::success('Success!', 'Student has successfully deleted');

        return redirect('/manajemen/mahasiswa');
    }
}
