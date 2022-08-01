<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Url extends Model
{
    use HasSoftDelete;

    protected $table = 'urls';

    protected $fillable = ['token', 'name', 'argvs'];

    protected $casts = ['argvs' => 'array'];
}
