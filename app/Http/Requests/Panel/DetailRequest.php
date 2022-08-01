<?php

namespace App\Http\Requests\Panel;

use System\Request\Request;

class DetailRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'name' => 'required|max:191',
                'profile' => 'file|mimes:jpeg,jpg,png,gif|max:2048',
                'bio' => 'required',
            ],
            'errors' => [
                'name' => 'required!اسم باید وارد شود.|max!اسم باید کمتر از ۱۹۱ حرف باشد.',
                'profile' => 'file!تصویر باید فایل باشد.|mimes!نوع عکس ارسالی معتبر نمیباشد.|max!عکس حداکثر باید ۲ مگابایت باشد.',
                'bio' => 'required!بایوگرافی باید وارد شود.',
            ],
        ];
    }
}
