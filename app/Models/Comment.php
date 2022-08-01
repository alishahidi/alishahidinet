<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Comment extends Model
{
    use HasSoftDelete;

    protected $table = 'comments';

    protected $fillable = ['user_id', 'article_id', 'status', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
}
