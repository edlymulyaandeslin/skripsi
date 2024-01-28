<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Judul;
use App\Models\Kompre;
use App\Models\Logbook;
use App\Models\NilaiKompre;
use App\Models\NilaiSempro;
use App\Models\Role;
use App\Models\Sempro;
use App\Models\TeamPembimbing;
use App\Models\TeamPenguji;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'role_id' => 1,
            'nim_or_nidn' => 83,
            'name' => 'Edly Mulya Andeslin',
            'email' => 'edlymulyaandeslin@gmail.com',
        ]);

        User::factory(14)->create();

        Judul::factory(1)->create();

        Logbook::factory(5)->create();

        Sempro::factory(1)->create();

        NilaiSempro::factory(1)->create();

        Kompre::factory(1)->create();

        NilaiKompre::factory(1)->create();

        TeamPenguji::factory(5)->create();


        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'koordinator',
        ]);
        Role::create([
            'name' => 'dosen',
        ]);
        Role::create([
            'name' => 'mahasiswa',
        ]);
    }
}
