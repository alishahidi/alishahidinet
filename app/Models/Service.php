<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Service extends Model
{
    use HasSoftDelete;

    protected $table = 'services';

    protected $fillable = ['name', 'icon'];
}
