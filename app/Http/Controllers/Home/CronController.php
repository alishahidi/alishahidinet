<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Services\Sitemap;
use System\Config\Config;

class CronController extends Controller
{
    public function sitemap($token)
    {
        if (! Config::get('CRON_TOKEN') === $token) {
            http_response_code(400);
            safeHeader($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request', '400 Bad Request');
        }

        file_put_contents('sitemap.xml', Sitemap::get());
        echo 'Request successfully submited.';
        exit;
    }
}
