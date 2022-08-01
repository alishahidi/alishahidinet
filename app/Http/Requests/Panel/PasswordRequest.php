<?php

namespace App\Http\Requests\Panel;

use System\Request\Request;

class PasswordRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'password' => 'required|min:8|confirmed',
            ],
            'errors' => [
                'password' => 'required!پسورد جدید باید وارد شود.|min!پسورد جدید حداقل باید ۸ حرف باشد.|confirmed!پسورد های جدید باید یکسان باشند.',
            ],
        ];
    }
}
