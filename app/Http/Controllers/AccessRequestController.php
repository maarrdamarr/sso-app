<?php

namespace App\Http\Controllers;

use App\Models\AccessRequest;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AccessRequestController extends Controller
{
    // user buat permintaan
    public function create()
    {
        $apps = Application::where('active', true)->orderBy('name')->get();
        return view('access_requests.create', compact('apps'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'application_id' => 'required|exists:applications,id',
            'reason' => 'nullable|string',
        ]);

        AccessRequest::create([
            'user_id' => Auth::id(),
            'application_id' => $data['application_id'],
            'reason' => $data['reason'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('access-requests.my')->with('success', 'Permintaan akses dikirim, tunggu persetujuan admin.');
    }

    // user lihat permintaan miliknya
    public function my()
    {
        $requests = AccessRequest::with('application')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('access_requests.my', compact('requests'));
    }

    // admin lihat semua
    public function index()
    {
        $requests = AccessRequest::with('user', 'application', 'reviewer')
            ->latest()
            ->get();

        return view('access_requests.index', compact('requests'));
    }

    public function approve(AccessRequest $accessRequest)
    {
        $accessRequest->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Permintaan disetujui.');
    }

    public function reject(AccessRequest $accessRequest)
    {
        $accessRequest->update([
            'status' => 'rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Permintaan ditolak.');
    }
}
