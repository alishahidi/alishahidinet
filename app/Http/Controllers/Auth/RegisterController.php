<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use System\Auth\Auth;
use System\Image\Image;

class RegisterController extends Controller
{
    public function view()
    {
        return view('app.register');
    }

    public function register()
    {
        $request = new RegisterRequest();
        $inputs = $request->all();
        $inputs['profile'] = [
            'thumbnail' => Image::make('profile', 'images/profile', true)->resize(60, 60)->saveFtp(quality: 90, unique: true, dateFormat: true),
            'main' => Image::make('profile', 'images/profile', true)->resize(120, 120)->saveFtp(quality: 90, unique: true, dateFormat: true),
        ];
        $inputs['permission'] = 'user';
        $inputs['status'] = 1;
        Auth::storeUser($inputs, 'password');
        flash('user_status', 'Successfully registered.');

        return redirect(route('auth.login'));
    }
}
