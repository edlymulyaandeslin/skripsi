<?php

namespace App\Policies;

use App\Models\Sempro;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SemproPolicy
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
    public function view(User $user, Sempro $sempro): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === 4;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sempro $sempro): bool
    {
        return $user->role_id === 2;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sempro $sempro): bool
    {
        return $user->id === $sempro->judul->mahasiswa_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Sempro $sempro): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Sempro $sempro): bool
    {
        //
    }
}
