<?php

namespace App\Http\Requests\Auth;

use System\Request\Request;

class LoginRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'email' => 'required|max:90|email',
                'password' => 'required|min:8',
                'captcha' => 'required|captcha',
            ],
            'errors' => [
                'email' => 'required!ایمیل باید وارد شود.|max!ایمیل باید کمتر از ۹۰ حرف باشد.|email!ایمیل معتبر نمیباشد',
                'password' => 'required!پسورد باید وارد شود.|min!پسورد حداقل باید ۸ حرف باشد.',
                'captcha' => 'required!کد امنیتی باید وارد شود.|captcha!کد امنیتی اشتباه است.',
            ],
        ];
    }
}
