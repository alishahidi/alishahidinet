<?php

namespace App\Http\Requests\Panel;

use System\Request\Request;

class CommentRequest extends Request
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
