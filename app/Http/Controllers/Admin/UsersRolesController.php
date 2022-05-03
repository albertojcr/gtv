<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersRolesController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);

        return back()->with('flash', 'Los roles han sido actualizados');
    }
}
