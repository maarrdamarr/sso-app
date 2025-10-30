<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'department')->get();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function updateRoles(Request $request, User $user)
    {
        $roleIds = $request->input('roles', []);
        $user->roles()->sync($roleIds);

        return back()->with('success', 'Role pengguna diperbarui.');
    }
}
