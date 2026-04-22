<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookPage extends Model
{
    protected $fillable = ['product_id', 'page_number', 'content', 'book_title'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
