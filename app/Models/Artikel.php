<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    protected $table = 'artikelen';

    protected $fillable = [
        'title',
        'slug',
        'intro',
        'content',
        'body',
        'featured_image',
        'featured_image_alt',
        'og_image',
        'seo_description',
        'show_featured_image',
        'is_published',
        'sort_order',
        'title_max_width',
    ];

    protected $casts = [
        'content'              => 'array',
        'is_published'         => 'boolean',
        'show_featured_image'  => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    public static function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $i = 1;

        $query = static::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $original . '-' . $i++;
            $query = static::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }
}

