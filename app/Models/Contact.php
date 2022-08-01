<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Contact extends Model
{
    use HasSoftDelete;

    protected $table = 'contacts';

    protected $fillable = ['name', 'email', 'subject', 'text', 'support_key'];

    public function answers()
    {
        return $this->hasMany(ContactAnswer::class, 'contact_id', 'id')->orderBy('created_at', 'DESC')->get();
    }
}
