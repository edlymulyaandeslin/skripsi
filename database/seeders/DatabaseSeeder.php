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

        // admin
        User::factory()->create([
            'role_id' => 1,
            'nim_or_nidn' => 81,
            'name' => 'Edly Mulya Andeslin',
            'email' => 'edlymulyaandeslin@gmail.com',
        ]);
        // koordinator
        User::factory()->create([
            'role_id' => 2,
            'nim_or_nidn' => 82,
            'name' => 'Urfi Utami M.Kom',
            'email' => 'urfiutami@gmail.com',
        ]);
        // dosen
        User::factory()->create([
            'role_id' => 3,
            'nim_or_nidn' => 80001,
            'name' => 'Khairul Sabri M.Kom',
            'email' => 'khairulsabri@gmail.com',
        ]);
        User::factory()->create([
            'role_id' => 3,
            'nim_or_nidn' => 80002,
            'name' => 'Dona M.Kom',
            'email' => 'dona@gmail.com',
            'posisi' => 'kaprodi'
        ]);
        User::factory()->create([
            'role_id' => 3,
            'nim_or_nidn' => 80003,
            'name' => 'Wirda Jannatuljannah M.Pd',
            'email' => 'wirdajannatuljannah@gmail.com',
        ]);
        User::factory()->create([
            'role_id' => 3,
            'nim_or_nidn' => 80004,
            'name' => 'Hendri Maradona M.Kom',
            'email' => 'hendrimaradona@gmail.com',
        ]);
        // mahasiswa
        User::factory()->create([
            'role_id' => 4,
            'nim_or_nidn' => 80005,
            'name' => 'Jesyca Michel',
            'email' => 'jesycamichel@gmail.com',
        ]);
        User::factory()->create([
            'role_id' => 4,
            'nim_or_nidn' => 80006,
            'name' => 'Muhammad Ridho',
            'email' => 'ridhokun@gmail.com',
        ]);
        User::factory()->create([
            'role_id' => 4,
            'nim_or_nidn' => 80008,
            'name' => 'Sayyid Jafar S',
            'email' => 'sayyidkun@gmail.com',
        ]);

        // User::factory(14)->create();

        // Judul::factory(1)->create();

        // Logbook::factory(5)->create();

        // Sempro::factory(1)->create();

        // // NilaiSempro::factory(1)->create();

        // Kompre::factory(1)->create();

        // NilaiKompre::factory(1)->create();


    }
}
