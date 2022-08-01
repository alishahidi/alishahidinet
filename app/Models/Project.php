<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Project extends Model
{
    use HasSoftDelete;

    protected $table = 'projects';

    protected $fillable = ['title', 'description', 'image', 'link'];
}
