<?php

namespace App\Http\Controllers;

use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        $apps = Application::all();
        return view('applications.index', compact('apps'));
    }
}
