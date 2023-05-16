<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class ExperienceRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'name' => 'required|max:380',
                'location' => 'required|max:380',
                'position' => 'required|max:380',
                'start' => 'required|max:380',
                'end' => 'required|max:380',
            ],
            'errors' => [
                'name' => 'required!نام باید وارد شود.|max!نام باید از ۳۸۰ حرف کمتر باشد.',
                'location' => 'required!موقعیت باید وارد شود.|max!موقعیت باید از ۳۸۰ حرف کمتر باشد.',
                'location' => 'required!عنوان باید وارد شود.|max!عنوان باید از ۳۸۰ حرف کمتر باشد.',
                'location' => 'required!شروع باید وارد شود.|max!شروع باید از ۳۸۰ حرف کمتر باشد.',
                'location' => 'required!پایان باید وارد شود.|max!پایان باید از ۳۸۰ حرف کمتر باشد.',
            ],
        ];
    }
}
