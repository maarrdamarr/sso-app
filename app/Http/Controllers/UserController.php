<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'department')->get();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }
}
