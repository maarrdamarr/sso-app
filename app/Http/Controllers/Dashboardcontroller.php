<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasRole(['superadmin', 'it-admin'])) {
            $apps = Application::where('active', true)->get();
        } else {
            $apps = Application::where('active', true)->get();
        }

        return view('dashboard.index', compact('user', 'apps'));
    }
}
