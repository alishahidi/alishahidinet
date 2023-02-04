<?php

namespace App\Models;

use System\Database\ORM\Model;

class BotPhoto extends Model
{
    protected $table = 'bot_photos';

    protected $fillable = ['user_id', 'base64_data', 'extension'];
}
