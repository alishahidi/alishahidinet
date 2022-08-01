<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class SkillRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'name' => 'required|max:380',
                'percent' => 'number|required|min:0|max:101',
            ],
            'errors' => [
                'name' => 'required!اسم باید وارد شود.|max!اسم باید از ۳۸۰ حرف کمتر باشد.',
                'percent' => 'number!درصد باید عدد باشد.|required!درصد باید وارد شود.|min!درصد حداقل باید ۰ باشد.|max!درصد حداکثر باید ۱۰۰ باشد.',
            ],
        ];
    }
}
