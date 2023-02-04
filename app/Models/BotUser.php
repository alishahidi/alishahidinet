<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class BotUser extends Model
{
    use HasSoftDelete;

    protected $table = 'bot_users';

    protected $fillable = ['user_id', 'is_login', 'login_id', 'state'];
}
