<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use System\Auth\Auth;

class LoginController extends Controller
{
    public function view()
    {
        return view('app.login');
    }

    public function login()
    {
        $request = new LoginRequest();
        $remember = $request->remember == 'on';
        if ($remember) {
            Auth::loginUsingEmail($request->email, $request->password, 'کاربری با مشخصات وارد شده پیدا نشد.', 'پسورد اشتباه است', $remember, 4 * 24 * 60 * 60);
        } else {
            Auth::loginUsingEmail($request->email, $request->password, 'کاربری با مشخصات وارد شده پیدا نشد.', 'پسورد اشتباه است');
        }
        $user = Auth::userUsingEmail($request->email);
        if ($user->permission == 'root') {
            return redirect(route('admin.index'));
        }

        return redirect(route('panel.index'));
    }
}
