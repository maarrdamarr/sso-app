<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'label' => 'nullable|string',
        ]);

        Role::create($data);

        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function destroy(Role $role)
    {
        // jangan hapus superadmin
        if ($role->name === 'superadmin') {
            return back()->with('error', 'Role ini tidak boleh dihapus.');
        }

        $role->delete();
        return back()->with('success', 'Role dihapus.');
    }
}
