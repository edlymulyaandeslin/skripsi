<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function index()
    {
        return view('koordinator.index', [
            'title' => 'E - Skripsi | Koordinator',
            'koordinators' => User::where('role_id', 2)->latest()->get()
        ]);
    }

    public function create()
    {
        return view('koordinator.create', [
            'title' => 'E - Skripsi | Tambah koordinator'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim_or_nidn' => 'required|min:5|max:8',
            'name' => 'required|max:255',
            'password' => 'required|min:8|max:255'
        ], [
            'nim_or_nidn.required' => 'The nidn field is required.',
            'nim_or_nidn.min' => 'The nidn field must be at least 5 characters.',
            'nim_or_nidn.max' => 'The nidn field must not be greater than 8 characters.',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $validateData['role_id'] = 2;

        User::create($validateData);

        return redirect('/manajemen/koordinator')->with('success', 'koordinator baru ditambahkan');
    }

    public function show($id)
    {
        $koordinator = User::with(['judul', 'judul.pembimbing1', 'judul.pembimbing2', 'judul.sempro', 'judul.kompre'])->find($id);

        return response()->json($koordinator);
    }

    public function edit($id)
    {
        return view('koordinator.edit', [
            'title' => 'koordinator | Edit',
            'koordinator' => User::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nim_or_nidn' => 'required|min:5|max:8',
            'name' => 'required|max:255',
        ];

        $customMessage = [
            'nim_or_nidn.required' => 'The nidn field is required.',
            'nim_or_nidn.min' => 'The nidn field min 5.',
            'nim_or_nidn.max' => 'The nidn field max 8.',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8|max:255';
        }

        $validateData = $request->validate($rules, $customMessage);

        if ($request->filled('password')) {
            $validateData['password'] = bcrypt($validateData['password']);
        }

        User::where('id', $id)->update($validateData);

        return redirect('/manajemen/koordinator')->with('success', 'koordinator berhasil di update');
    }
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/manajemen/koordinator')->with('success', 'koordinator berhasil di hapus');
    }
}