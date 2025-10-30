<?php

namespace App\Http\Controllers;

use App\Models\SsoLog;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SsoLogController extends Controller
{
    // untuk admin
    public function index(Request $request)
    {
        $appId = $request->input('application_id');
        $userId = $request->input('user_id');

        $logs = SsoLog::with('user', 'application')
            ->when($appId, function ($q) use ($appId) {
                $q->where('application_id', $appId);
            })
            ->when($userId, function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->latest()
            ->paginate(20);

        $applications = Application::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('sso.logs', compact('logs', 'applications', 'users', 'appId', 'userId'));
    }

    // untuk user sendiri
    public function my(Request $request)
    {
        $user = Auth::user();

        $logs = SsoLog::with('application')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return view('sso.my', compact('logs', 'user'));
    }
}
