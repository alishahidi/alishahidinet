<?php

namespace App\Http\Requests\Home;

use System\Request\Request;

class UserCommentRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'comment' => 'required',
            ],
            'errors' => [
                'comment' => 'required!کامنت باید وارد شود.',
            ],
        ];
    }
}
