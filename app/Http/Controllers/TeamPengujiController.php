<?php

namespace App\Http\Controllers;

use App\Models\TeamPenguji;
use App\Http\Requests\StoreTeamPengujiRequest;
use App\Http\Requests\UpdateTeamPengujiRequest;
use App\Models\User;
use Illuminate\Http\Request;

class TeamPengujiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teampenguji.index', [
            'title' => 'E - Skripsi | Team Penguji',
            'listteampenguji' => TeamPenguji::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teampenguji.create', [
            'title' => 'Team Penguji | Create',
            'listpenguji' => User::where('role_id', 3)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'penguji1' => 'required',
            'penguji2' => 'required',
            'penguji3' => 'required',
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'penguji1.required' => 'penguji 1 tidak boleh kosong',
            'penguji2.required' => 'penguji 2 tidak boleh kosong',
            'penguji3.required' => 'penguji 3 tidak boleh kosong',
        ]);

        TeamPenguji::create($validateData);

        return redirect('/manajemen/teampenguji')->with('success', 'Team Penguji Berhasil di Buat!!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $teamPenguji = TeamPenguji::find($id);

        return response()->json($teamPenguji);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('teampenguji.edit', [
            'title' => 'Team Penguji | Edit',
            'teampenguji' => TeamPenguji::find($id),
            'dosens' => User::where('role_id', 3)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required'
        ];
        $customMessage = [
            'name.required' => 'Nama tidak boleh kosong'
        ];

        if ($request->filled('penguji1')) {
            $rules['penguji1'] = 'required';
        }
        if ($request->filled('penguji2')) {
            $rules['penguji2'] = 'required';
        }
        if ($request->filled('penguji3')) {
            $rules['penguji3'] = 'required';
        }

        $validateData = $request->validate($rules, $customMessage);

        TeamPenguji::where('id', $id)->update($validateData);

        return redirect('/manajemen/teampenguji')->with('success', 'Team Penguji Berhasil di Update!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TeamPenguji::destroy($id);

        return redirect('/manajemen/teampenguji')->with('success', 'Team Penguji Berhasil di Hapus!!');
    }
}
