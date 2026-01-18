<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Basic product info
            $table->string('title');
            $table->string('slug');
            $table->string('base_title')->nullable();
            $table->string('base_slug')->nullable();

            // Unique constraints
            $table->unique(['title', 'deleted_at']);
            $table->unique(['slug', 'deleted_at']);

            // Foreign keys
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->nullOnDelete();
            $table->foreignId('product_copy_id')->nullable()->constrained('product_copies')->nullOnDelete();

            // Descriptions
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();

            // Pricing & stock
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('stock')->default(0)->nullable();

            // Physical dimensions (for shipping)
            $table->decimal('weight', 8, 0)->nullable();
            $table->decimal('height', 8, 0)->nullable();
            $table->decimal('width', 8, 0)->nullable();
            $table->decimal('depth', 8, 0)->nullable();

            // Book specific fields
            $table->integer('pages')->nullable();
            $table->string('binding_type')->nullable();
            $table->string('ean_code')->nullable();

            // Images
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();

            // SEO fields
            $table->string('seo_description')->nullable();
            $table->json('seo_tags')->nullable();
            $table->string('seo_author')->nullable();
            $table->string('seo_robots')->nullable();
            $table->string('seo_canonical_url')->nullable();

            // Publishing status
            $table->boolean('is_published')->default('0');

            // User tracking (string for flexibility)
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

