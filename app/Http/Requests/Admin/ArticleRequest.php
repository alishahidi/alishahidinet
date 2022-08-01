<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class ArticleRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'rules' => [
                    'title' => 'required|max:380',
                    'description' => 'required|max:380',
                    'content' => 'required',
                    'topic_id' => 'required|exists:topics,id',
                    'image' => 'file|max:1600|mimes:jpeg,jpg,png',
                ],
                'errors' => [
                    'title' => 'required!عنوان باید وارد شود.|max!عنوان باید از ۳۸۰ حرف کمتر باشد.',
                    'description' => 'required!توضیحات باید وارد شود.|max!توضیحات باید از ۳۸۰ حرف کمتر باشد.',
                    'content' => 'required!متن باید وارد شود.',
                    'topic_id' => 'required!باید تاپیک را انتخاب کنید.|exists!چنین تاپیکی وجود ندارد.',
                    'image' => 'mimes!نوع عکس ارسالی غلط است.|max!حجم فایل باید کمتر از ۱.۶ مگابایت باشد',
                ],
            ];
        }

        return [
            'rules' => [
                'title' => 'required|max:380',
                'description' => 'required|max:380',
                'content' => 'required',
                'topic_id' => 'required|exists:topics,id',
                'image' => 'required|max:1600|file|mimes:jpeg,jpg,png',
            ],
            'errors' => [
                'title' => 'required!عنوان باید وارد شود.|max!عنوان باید از ۳۸۰ حرف کمتر باشد.',
                'description' => 'required!توضیحات باید وارد شود.|max!توضیحات باید از ۳۸۰ حرف کمتر باشد.',
                'content' => 'required!متن باید وارد شود.',
                'topic_id' => 'required!باید تاپیک را انتخاب کنید.|exists!چنین تاپیکی وجود ندارد.',
                'image' => 'mimes!نوع عکس ارسالی غلط است.|required!عکس باید انتخاب شود.|max!حجم فایل باید کمتر از ۱.۶ مگابایت باش',
            ],
        ];
    }
}
