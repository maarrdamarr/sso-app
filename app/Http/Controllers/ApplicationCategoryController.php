<?php

namespace App\Http\Controllers;

use App\Models\ApplicationCategory;
use Illuminate\Http\Request;

class ApplicationCategoryController extends Controller
{
    public function index()
    {
        $categories = ApplicationCategory::withCount('applications')->orderBy('name')->get();
        return view('app_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        ApplicationCategory::create($data);

        return back()->with('success', 'Kategori aplikasi ditambahkan.');
    }

    public function destroy(ApplicationCategory $category)
    {
        // kalau sudah dipakai aplikasi, di dunia nyata kita blok. Untuk sekarang: hapus saja
        $category->delete();

        return back()->with('success', 'Kategori dihapus.');
    }
}
