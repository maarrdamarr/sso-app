<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('name')->get();
        return view('departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'code' => 'nullable|string|max:50',
        ]);

        Department::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return back()->with('success', 'Departemen ditambahkan.');
    }

    public function destroy(Department $department)
    {
        // kalau dipakai user, boleh kamu rubah ke soft delete, tapi untuk sekarang langsung hapus
        $department->delete();

        return back()->with('success', 'Departemen dihapus.');
    }
}
