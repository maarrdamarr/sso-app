<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $apps = Application::with('roles')->get();
        return view('applications.index', compact('apps'));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'required|string|max:150|unique:applications,slug',
            'url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'active' => 'nullable|boolean',
        ]);

        $data['active'] = $request->boolean('active');

        Application::create($data);

        return redirect()->route('applications.index')->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    public function edit(Application $application)
    {
        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'required|string|max:150|unique:applications,slug,' . $application->id,
            'url' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'active' => 'nullable|boolean',
        ]);

        $data['active'] = $request->boolean('active');

        $application->update($data);

        return redirect()->route('applications.index')->with('success', 'Aplikasi berhasil diupdate.');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('applications.index')->with('success', 'Aplikasi dihapus.');
    }

    // =========== ROLE PER APLIKASI =============
    public function editRoles(Application $application)
    {
        $roles = Role::all();
        $appRoleIds = $application->roles->pluck('id')->toArray();

        return view('applications.roles', compact('application', 'roles', 'appRoleIds'));
    }

    public function updateRoles(Request $request, Application $application)
    {
        $roleIds = $request->input('roles', []); // array
        $application->roles()->sync($roleIds);

        return redirect()->route('applications.index')->with('success', 'Role aplikasi diperbarui.');
    }
}
