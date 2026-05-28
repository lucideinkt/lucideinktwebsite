<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSeoSetting extends Model
{
    protected $fillable = [
        'page_key',
        'title',
        'description',
        'author',
        'robots',
        'canonical_url',
        'og_image',
        'type',
    ];
}

