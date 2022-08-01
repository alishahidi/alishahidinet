<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Skill extends Model
{
    use HasSoftDelete;

    protected $table = 'skills';

    protected $fillable = ['name', 'percent'];
}
