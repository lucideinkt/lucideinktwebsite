<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedInteger('page_number');
            $table->longText('content');
            $table->string('book_title')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'page_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_pages');
    }
};

