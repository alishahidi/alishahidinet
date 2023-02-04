<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Fal extends Model
{
    use HasSoftDelete;

    protected $table = 'fals';

    protected $fillable = ['poem', 'interpretation'];
}
