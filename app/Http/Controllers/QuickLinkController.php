<?php

namespace App\Http\Controllers;

use App\Models\QuickLink;
use Illuminate\Http\Request;

class QuickLinkController extends Controller
{
    // admin manage
    public function index()
    {
        $links = QuickLink::orderBy('category')->orderBy('order')->get();
        return view('quick_links.index', compact('links'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'url' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
        ]);

        QuickLink::create($data);

        return back()->with('success', 'Link ditambahkan.');
    }

    public function destroy(QuickLink $quickLink)
    {
        $quickLink->delete();

        return back()->with('success', 'Link dihapus.');
    }

    // user lihat
    public function public()
    {
        $links = QuickLink::orderBy('category')->orderBy('order')->get();
        return view('quick_links.public', compact('links'));
    }
}
