<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\UploadImageRequest;
use App\Http\Services\ImageUpload;

class ImageController extends Controller
{
    public function upload()
    {
        new UploadImageRequest(false);
        $image = ImageUpload::dateFormatUploadEditor('file');
        echo asset_ftp($image);
    }
}
