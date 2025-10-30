<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AnnouncementController extends Controller
{
    // list untuk admin
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    // form tambah
    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        Announcement::create([
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'published_at' => now(),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman dibuat.');
    }

    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $announcement->update([
            'title' => $data['title'],
            'body' => $data['body'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('announcements.index')->with('success', 'Pengumuman diupdate.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('announcements.index')->with('success', 'Pengumuman dihapus.');
    }

    // ini buat user biasa (dashboard)
    public function latest()
    {
        $announcements = Announcement::where('is_active', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('announcements.latest', compact('announcements'));
    }
}
