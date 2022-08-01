<?php

namespace App\Http\Requests\File;

use System\Request\Request;

class UploadImageRequest extends Request
{
    public function rules()
    {
        return [
            'rules' => [
                'file' => 'required|file|max:1200|mimes:jpeg,jpg,png,gif',
            ],
        ];
    }
}
