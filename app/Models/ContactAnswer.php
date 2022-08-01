<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class ContactAnswer extends Model
{
    use HasSoftDelete;

    protected $table = 'contact_answers';

    protected $fillable = ['subject', 'text', 'user_id', 'contact_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
