<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class ServiceRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'name' => 'required|max:380',
                'icon' => 'required|max:380',
            ],
            'errors' => [
                'name' => 'required!اسم باید وارد شود.|max!اسم باید از ۳۸۰ حرف کمتر باشد.',
                'icon' => 'required!آیکون باید وارد شود.|max!آیکون باید از ۳۸۰ حرف کمتر باشد.',
            ],
        ];
    }
}
