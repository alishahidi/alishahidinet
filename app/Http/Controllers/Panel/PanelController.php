<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use System\Auth\Auth;

class PanelController extends Controller
{
    public function __construct()
    {
        Auth::check();
    }

    public function index()
    {
        $user = Auth::user();
        $commentCount = $user->comments()->count();

        return view('panel.index', compact('commentCount'));
    }
}
