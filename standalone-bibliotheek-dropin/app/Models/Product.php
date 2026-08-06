<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'pdf_file',
        'pdf_reader_enabled',
        'book_content_published',
        'online_lezen_image',
        'image_1',
        'category_id',
        'product_copy_id',
        'price',
        'stock',
        'is_published',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'book_content_published' => 'boolean',
        'pdf_reader_enabled' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function bookPages(): HasMany
    {
        return $this->hasMany(BookPage::class)->orderBy('page_number');
    }
}

