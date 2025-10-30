<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // user: form
    public function create()
    {
        return view('feedback.create');
    }

    // user: kirim
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:150',
            'message' => 'required|string',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
        ]);

        return back()->with('success', 'Terima kasih, feedback kamu sudah terkirim.');
    }

    // admin: lihat semua
    public function index()
    {
        $feedback = Feedback::with('user')->latest()->get();
        return view('feedback.index', compact('feedback'));
    }
}
