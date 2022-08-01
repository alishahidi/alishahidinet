<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class ContactAnswerRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'subject' => 'required|max:380',
                'text' => 'required',
            ],
            'errors' => [
                'subject' => 'required!موضوغ باید وارد شود.|max!موضوع باید از ۳۸۰ حرف کمتر باشد.',
                'text' => 'required!متن باید وارد شود.',
            ],
        ];
    }
}
