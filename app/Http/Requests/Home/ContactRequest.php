<?php

namespace App\Http\Requests\Home;

use System\Request\Request;

class ContactRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'name' => 'required|max:380',
                'email' => 'required|max:90|email',
                'subject' => 'required|max:380',
                'text' => 'required',
                'captcha' => 'required|captcha',
            ],
            'errors' => [
                'name' => 'required!اسم باید وارد شود.|max!اسم باید از ۳۸۰ حرف کمتر باشد.',
                'email' => 'required!ایمیل باید وارد شود.|max!ایمیل باید کمتر از ۹۰ حرف باشد.|email!ایمیل معتبر نمیباشد',
                'subject' => 'required!موضوع باید وارد شود.|max!موضوع باید از ۳۸۰ حرف کمتر باشد.',
                'text' => 'required!پیام باید وارد شود.',
                'captcha' => 'required!کد امنیتی باید وارد شود.|captcha!کد امنیتی اشتباه است.',
            ],
        ];
    }
}
