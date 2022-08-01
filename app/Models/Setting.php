<?php

namespace App\Models;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Setting extends Model
{
    use HasSoftDelete;

    protected $table = 'settings';

    protected $fillable = ['header_brand', 'hero_title', 'hero_subtitle', 'hero_image', 'hero_btn_primary', 'hero_btn_secondary', 'aside_contact_title', 'aside_contact_icons', 'aside_contact_links', 'aside_newsletter_title', 'aside_newsletter_btn', 'footer_title', 'footer_icon', 'footer_fast_links', 'footer_contact_email', 'footer_copyright'];

    protected $casts = ['aside_contact_icons' => 'array', 'aside_contact_links' => 'array', 'footer_fast_links' => 'array'];
}
