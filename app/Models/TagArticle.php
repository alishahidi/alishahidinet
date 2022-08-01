<?php

namespace App\Models;

use System\Database\ORM\Model;

class TagArticle extends Model
{
    protected $table = 'tag_article';

    protected $fillable = ['article_id', 'tag_id'];
}
