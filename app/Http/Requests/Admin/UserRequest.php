<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class UserRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'name' => 'required|max:191',
                'email' => 'required|max:90|email',
                'profile' => 'file|mimes:jpeg,jpg,png,gif|max:2048',
                'password' => 'min:8|confirmed',
                'bio' => 'required',
                'captcha' => 'captcha',
            ],
            'errors' => [
                'name' => 'required!اسم باید وارد شود.|max!اسم باید کمتر از ۱۹۱ حرف باشد.',
                'email' => 'required!ایمیل باید وارد شود.|max!ایمیل باید کمتر از ۹۰ حرف باشد.|email!ایمیل معتبر نمیباشد|unique!ایمیل تکراری است.',
                'profile' => 'file!تصویر باید فایل باشد.|mimes!نوع عکس ارسالی معتبر نمیباشد.|max!عکس حداکثر باید ۲ مگابایت باشد.',
                'password' => 'min!پسورد حداقل باید ۸ حرف باشد.|confirmed!پسورد ها باید یکسان باشند.',
                'bio' => 'required!بایوگرافی باید وارد شود.',
            ],
        ];
    }
}
