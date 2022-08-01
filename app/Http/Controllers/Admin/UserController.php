<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Http\Services\ImageUpload;
use App\Models\User;
use System\Auth\Auth;
use System\Image\Image;
use System\Request\Request;

class UserController extends AdminController
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();

        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update($id)
    {
        $request = new UserRequest();
        $inputs = $request->all();
        $inputs['id'] = $id;
        if ($request->file("profile")["tmp_name"]) {
            $inputs['profile'] = [
                'thumbnail' => Image::make("profile", "images/profile", true)->resize(60, 60)->saveFtp(quality: 90, unique: true, dateFormat: true),
                'main' => Image::make("profile", "images/profile", true)->resize(120, 120)->saveFtp(quality: 90, unique: true, dateFormat: true)
            ];;
        }
        Auth::updateUser($inputs, ['id', 'name', 'profile', 'bio', 'password'], 'password');

        return redirect(route('admin.user.index'));
    }

    public function destroy($id)
    {
        new Request();
        User::delete($id);

        return back();
    }
}
