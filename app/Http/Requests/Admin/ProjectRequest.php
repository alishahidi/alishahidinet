<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class ProjectRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'rules' => [
                    'title' => 'required|max:380',
                    'description' => 'required|max:380',
                    'image' => 'file|max:1600|mimes:jpeg,jpg,png',
                    'link' => 'required|max:380',
                ],
                'errors' => [
                    'title' => 'required!عنوان باید وارد شود.|max!عنوان باید از ۳۸۰ حرف کمتر باشد.',
                    'description' => 'required!توضیحات باید وارد شود.|max!توضیحات باید از ۳۸۰ حرف کمتر باشد.',
                    'image' => 'mimes!نوع عکس ارسالی غلط است.|max!حجم فایل باید کمتر از ۱.۶ مگابایت باشد',
                    'link' => 'required!لینک باید وارد شود.|max!لینک باید از ۳۸۰ حرف کمتر باشد.',
                ],
            ];
        }

        return [
            'rules' => [
                'title' => 'required|max:380',
                'description' => 'required|max:380',
                'image' => 'required|max:1600|file|mimes:jpeg,jpg,png',
                'link' => 'required|max:380',
            ],
            'errors' => [
                'title' => 'required!عنوان باید وارد شود.|max!عنوان باید از ۳۸۰ حرف کمتر باشد.',
                'description' => 'required!توضیحات باید وارد شود.|max!توضیحات باید از ۳۸۰ حرف کمتر باشد.',
                'image' => 'mimes!نوع عکس ارسالی غلط است.|required!عکس باید انتخاب شود.|max!حجم فایل باید کمتر از ۱.۶ مگابایت باش',
                'link' => 'required!لینک باید وارد شود.|max!لینک باید از ۳۸۰ حرف کمتر باشد.',
            ],
        ];
    }
}
