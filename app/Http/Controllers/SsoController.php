<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\SsoToken;
use App\Models\SsoLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SsoController extends Controller
{
    public function redirect(string $slug, Request $request)
    {
        $app = Application::where('slug', $slug)->where('active', true)->firstOrFail();
        $user = Auth::user();

        // generate token
        $token = Str::random(48);

        SsoToken::create([
            'user_id' => $user->id,
            'application_id' => $app->id,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(15),
        ]);

        // simpan LOG
        SsoLog::create([
            'user_id'       => $user->id,
            'application_id'=> $app->id,
            'ip_address'    => $request->ip(),
            'user_agent'    => substr($request->userAgent() ?? '', 0, 255),
        ]);

        // tampilkan halaman "berhasil"
        return view('sso.redirect', [
            'app'   => $app,
            'token' => $token,
            'user'  => $user,
        ]);
    }
}
