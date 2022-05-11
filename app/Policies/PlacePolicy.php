<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlacePolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        return $user->hasRole('Administrador') || $user->hasRole('Super Administrador') ? true : null;
    }

    /**
     * Determine whether the user can view the point of interest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Place  $place
     * @return mixed
     */
    public function view(User $user, Place $place)
    {
        return $user->id === $place->creator || $user->id === $place->updater || $user->hasPermissionTo('Ver lugares');
    }

    /**
     * Determine whether the user can create point of interests.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Crear lugares');
    }

    /**
     * Determine whether the user can update the point of interest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Place  $place
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermissionTo('Editar lugares');
    }

    /**
     * Determine whether the user can delete the point of interest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Place  $place
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('Borrar lugares');
    }
}
