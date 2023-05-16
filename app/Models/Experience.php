<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Experience extends Model
{
    use HasSoftDelete;

    protected $table = 'experiences';

    protected $fillable = ['name', 'location', 'position', 'start', 'end'];
}
