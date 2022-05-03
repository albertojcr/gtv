<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersPermissionsController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->permissions()->detach();
        $user->givePermissionTo($request->permissions);
        return back()->with('flash', 'Los permisos han sido actualizados');
    }
}
