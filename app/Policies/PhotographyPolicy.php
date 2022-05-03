<?php

namespace App\Policies;

use App\Models\Photography;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotographyPolicy
{
    use HandlesAuthorization;

    public function before(User $user   )
    {
       return $user->hasRole('Administrador') || $user->hasRole('Super Administrador') ? true : null;
    }

    /**
     * Determine whether the user can view the photography.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Photography  $photography
     * @return mixed
     */
    public function view(User $user, Photography $photography)
    {
        return $user->id === $photography->creator || $user->id === $photography->updater || $user->hasPermissionTo('Ver fotografias');
    }

    /**
     * Determine whether the user can create photographies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Crear fotografias');
    }

    /**
     * Determine whether the user can update the photography.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Photography  $photography
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermissionTo('Editar fotografias');
    }

    /**
     * Determine whether the user can delete the photography.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Photography  $photography
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('Borrar fotografias');
    }
}
