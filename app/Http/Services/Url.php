<?php

namespace App\Http\Services;

use App\Models\Url as UrlModel;
use Ramsey\Uuid\Uuid;

class Url
{
    private static function generateUniqueToken()
    {
        do {
            $uuid = Uuid::uuid4()->toString();
            $token = substr(md5($uuid), 0, 6);
            $tokenExist = UrlModel::where('token', $token)->get()[0];
        } while ($tokenExist);

        return $token;
    }

    public static function set($name, $argvs = null)
    {
        $token = self::generateUniqueToken();
        $url = UrlModel::create([
            'token' => $token,
            'name' => $name,
            'argvs' => $argvs,
        ]);

        return $url->insertId;
    }

    public static function get($token)
    {
        $url = UrlModel::where('token', $token)->get()[0];
        if (! $url) {
            return false;
        }

        return route($url->name, $url->argvs);
    }
}
