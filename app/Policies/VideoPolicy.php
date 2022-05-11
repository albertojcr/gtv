<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        return $user->hasRole('Administrador') || $user->hasRole('Super Administrador') ? true : null;
    }

    /**
     * Determine whether the user can view the photography.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Video  $video
     * @return mixed
     */
    public function view(User $user, Video $video)
    {
        return $user->id === $video->creator || $user->id === $video->updater || $user->hasPermissionTo('Ver videos');
    }

    /**
     * Determine whether the user can create photographies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Crear videos');
    }

    /**
     * Determine whether the user can update the photography.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Video  $video
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasPermissionTo('Editar videos');
    }

    /**
     * Determine whether the user can delete the photography.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Video  $video
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('Borrar videos');
    }
}
