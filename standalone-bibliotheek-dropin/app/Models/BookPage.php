<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'page_number',
        'content',
        'book_title',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

