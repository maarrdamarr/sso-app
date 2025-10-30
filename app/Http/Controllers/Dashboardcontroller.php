<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // kalau super
        if ($user->hasRole(['superadmin', 'it-admin'])) {
            $apps = Application::where('active', true)->get();
        } else {
            // ambil semua role id user
            $roleIds = $user->roles->pluck('id')->toArray();

            // ambil aplikasi yang punya salah satu role itu
            $apps = Application::whereHas('roles', function ($q) use ($roleIds) {
                $q->whereIn('roles.id', $roleIds);
            })
            ->where('active', true)
            ->get();
        }

        return view('dashboard.index', compact('user', 'apps'));
    }
}
