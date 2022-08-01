<?php

namespace App\Http\Requests\Home;

use System\Request\Request;

class ContactShowRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'support_key' => 'required',
            ],
            'errors' => [
                'support_key' => 'required!کد باید وارد شود.',
            ],
        ];
    }
}
