<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class User extends Model
{
    use HasSoftDelete;

    protected $table = 'users';

    protected $fillable = ['email', 'profile', 'name', 'password', 'status', 'permission', 'bio'];

    protected $casts = ['profile' => 'array'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
