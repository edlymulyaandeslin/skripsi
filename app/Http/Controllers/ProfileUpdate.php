<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileUpdate extends Controller
{
    public function index($id)
    {
        return view('manajemen.profile.index', [
            'title' => 'E - Skripsi | Profile',
            'user' => User::find($id)
        ]);
    }

    public function edit($id)
    {
        return view('manajemen.profile.edit', [
            'title' => 'Profile | Edit',
            'user' => User::find($id)
        ]);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'name' => 'required|max:50',
            'foto_profil' => 'image|file|max:1024',
        ];

        $customMessage = [];

        if ($request->filled('jenis_kelamin')) {
            $rules['jenis_kelamin'] = 'required';
        }
        if ($request->filled('email')) {
            $rules['email'] = 'required|email|unique:users,email,' . $id;
        }
        if ($request->filled('no_hp')) {
            $rules['no_hp'] = ['numeric', 'regex:/^\d{10,13}$/'];
            $customMessage['no_hp.regex'] = 'The no hp field range 10 - 13 characters';
        }
        if ($request->filled('tempat_lahir')) {
            $rules['tempat_lahir'] = 'required|min:5|max:50';
        }
        if ($request->filled('tanggal_lahir')) {
            $rules['tanggal_lahir'] = 'required';
        }
        if ($request->filled('alamat')) {
            $rules['alamat'] = 'required|min:5|max:50';
        }
        if ($request->filled('angkatan')) {
            $rules['angkatan'] = 'required|numeric|min:2019|max:' . date('Y');
        }
        if ($request->filled('password')) {
            $rules['password'] = 'required|min:8|max:255';
        }

        $validateData = $request->validate($rules, $customMessage);

        if ($request->filled('no_hp')) {
            $validateData['no_hp'] = intval($validateData['no_hp']);
        }

        if ($request->file('foto_profil')) {
            if ($request->oldProfil) {
                Storage::delete($request->oldProfil);
            }
            $validateData['foto_profil'] = $request->file('foto_profil')->store('post-profil');
        }

        User::where('id', $id)->update($validateData);

        Alert::success('Success', 'Profile has been updated');

        return redirect('/manajemen/profile/' . $id);
    }
}
