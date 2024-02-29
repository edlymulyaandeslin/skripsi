<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BobotController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bobot $bobot)
    {
        return view('bobot.edit', [
            'title' => 'E - Skripsi | Bobot Nilai',
            'bobot' => $bobot
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bobot $bobot)
    {
        $validateData = $request->validate([
            'bobot1' => 'required|numeric|max:10',
            'bobot2' => 'required|numeric|max:10',
            'bobot3' => 'required|numeric|max:10',
            'bobot4' => 'required|numeric|max:10',
        ]);

        $bobot->update($validateData);

        Alert::success('Berhasil', 'Bobot Nilai Diterapkan');
        return redirect('/nilai/kompre');
    }
}
