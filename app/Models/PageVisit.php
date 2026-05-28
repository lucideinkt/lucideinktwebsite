<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = [
        'url',
        'route_name',
        'page_type',
        'page_title',
        'product_id',
        'ip_hash',
        'session_hash',
        'user_id',
        'user_agent',
        'referer',
        'device_type',
        'country_code',
        'country',
        'city',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

