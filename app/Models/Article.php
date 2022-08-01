<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Article extends Model
{
    use HasSoftDelete;

    protected $table = 'articles';

    protected $fillable = ['title', 'description', 'content', 'image', 'topic_id', 'user_id', 'url_id'];

    protected $casts = ['tags' => 'array', 'image' => 'array'];

    public function url()
    {
        return $this->belongsTo(Url::class, 'url_id', 'id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id')->where('status', 1)->get();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_article', 'id', 'article_id', 'tag_id', 'id')->get();
    }
}
