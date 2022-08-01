<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Topic extends Model
{
    use HasSoftDelete;

    protected $table = 'topics';

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'topic_id', 'id');
    }
}
