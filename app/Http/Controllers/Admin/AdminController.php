<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use System\Auth\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        Auth::check();
        if (Auth::user()->permission != 'root') {
            redirect(route('auth.login.view'));
            exit;
        }
    }

    public function index()
    {
        return view('admin.index');
    }
}
