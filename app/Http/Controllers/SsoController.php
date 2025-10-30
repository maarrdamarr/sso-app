<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\SsoToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SsoController extends Controller
{
    public function redirect(string $slug)
    {
        $app = Application::where('slug', $slug)->where('active', true)->firstOrFail();
        $user = Auth::user();

        $token = Str::random(48);

        SsoToken::create([
            'user_id' => $user->id,
            'application_id' => $app->id,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(15),
        ]);

        return view('sso.redirect', [
            'app' => $app,
            'token' => $token,
            'user' => $user,
        ]);
    }
}
