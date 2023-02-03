<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\Panel\DetailRequest;
use System\Auth\Auth;
use System\Image\Image;

class DetailController extends PanelController
{
    public function index()
    {
        return redirect(route('panel.detail.edit'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('panel.detail.edit', compact('user'));
    }

    public function update()
    {
        $request = new DetailRequest();
        $inputs = $request->all();
        $user = Auth::user();
        $inputs['id'] = $user->id;
        if ($request->file('profile')['tmp_name']) {
            $inputs['profile'] = [
                'thumbnail' => Image::make('profile', 'images/profile', true)->resize(60, 60)->save(quality: 90, unique: true, dateFormat: true),
                'main' => Image::make('profile', 'images/profile', true)->resize(120, 120)->save(quality: 90, unique: true, dateFormat: true),
            ];
        }
        Auth::updateUser($inputs, ['id', 'name', 'profile', 'bio']);
        flash('user_status', 'با موفقیت آپدیت شد.');

        return redirect(route('panel.detail.edit'));
    }
}
