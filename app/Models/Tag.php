<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Tag extends Model
{
    use HasSoftDelete;

    protected $table = 'tags';

    protected $fillable = ['name', 'article_id'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'tag_article', 'id', 'tag_id', 'article_id', 'id');
    }
}
