<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->boolean('is_published')->default(true);
            $table->boolean('book_content_published')->default(true);
            $table->boolean('pdf_reader_enabled')->default(false);
            $table->string('pdf_file')->nullable();
            $table->string('online_lezen_image')->nullable();
            $table->string('image_1')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('product_copy_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

