<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPdfPage extends Model
{
    protected $fillable = ['product_id', 'page_number', 'content'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
