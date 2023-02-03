<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\UploadImageRequest;
use System\Image\Image;

class ImageController extends Controller
{
    public function upload()
    {
        new UploadImageRequest(false);
        $image = Image::make('file')->save(quality: 45, unique: true, dateFormat: true);
        echo asset($image);
    }
}
