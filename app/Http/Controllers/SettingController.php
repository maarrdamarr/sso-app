<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('key')->get();
        return view('settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:100',
            'value' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // upsert
        $setting = Setting::updateOrCreate(
            ['key' => $data['key']],
            [
                'value' => $data['value'] ?? null,
                'description' => $data['description'] ?? null,
            ]
        );

        return back()->with('success', 'Pengaturan disimpan.');
    }
}
