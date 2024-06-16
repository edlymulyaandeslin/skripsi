<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Judul;
use App\Models\Kompre;
use App\Models\Logbook;
use App\Models\NilaiKompre;
use App\Models\NilaiSempro;
use App\Models\Sempro;
use App\Models\User;
use App\Policies\JudulPolicy;
use App\Policies\KomprePolicy;
use App\Policies\LogbookPolicy;
use App\Policies\NilaiKomprePolicy;
use App\Policies\NilaiSemproPolicy;
use App\Policies\SemproPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Judul::class => JudulPolicy::class,
        Logbook::class => LogbookPolicy::class,
        Sempro::class => SemproPolicy::class,
        NilaiSempro::class => NilaiSemproPolicy::class,
        Kompre::class => KomprePolicy::class,
        NilaiKompre::class => NilaiKomprePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::define('admin', function (User $user) {
            return $user->role_id == 1;
        });
        Gate::define('koordinator', function (User $user) {
            return $user->role_id == 2;
        });
        Gate::define('dosen', function (User $user) {
            return $user->role_id == 3;
        });
        Gate::define('mahasiswa', function (User $user) {
            return $user->role_id == 4;
        });
    }
}
