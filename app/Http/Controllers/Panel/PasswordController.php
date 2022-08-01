<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\Panel\PasswordRequest;
use System\Auth\Auth;
use System\Security\Security;

class PasswordController extends PanelController
{
    public function index()
    {
        return redirect(route('panel.password.edit'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('panel.password.edit', compact('user'));
    }

    public function update()
    {
        $request = new PasswordRequest();
        $inputs = $request->all();
        $user = Auth::user();
        $inputs['id'] = $user->id;
        if (! Security::cheackPassword($user->password, $inputs['password_old'])) {
            error('password_wrong', 'پسورد فعلی اشتباه است.');

            return redirect(route('panel.password.edit'));
        }
        unset($inputs['password_old']);
        Auth::updateUser($inputs, ['id', 'password'], 'password');
        flash('user_status', 'با موفقیت آپدیت شد.');

        return redirect(route('panel.password.edit'));
    }
}
