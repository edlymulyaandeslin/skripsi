<?php

namespace App\Policies;

use App\Models\NilaiKompre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NilaiKomprePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NilaiKompre $nilaiKompre): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->role_id === 3;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NilaiKompre $nilaiKompre): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NilaiKompre $nilaiKompre): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NilaiKompre $nilaiKompre): bool
    {
        //
    }
}
