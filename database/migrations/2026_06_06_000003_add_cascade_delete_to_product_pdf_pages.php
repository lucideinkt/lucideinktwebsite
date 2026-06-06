<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // First delete any orphaned rows (product_id with no matching product)
        \DB::table('product_pdf_pages')
            ->whereNotIn('product_id', \DB::table('products')->pluck('id'))
            ->delete();

        // Add foreign key with cascade delete so rows are auto-removed
        // when a product is hard-deleted (forceDelete)
        try {
            Schema::table('product_pdf_pages', function (Blueprint $table) {
                $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
            });
        } catch (\Throwable $e) {
            // Foreign key may already exist — safe to ignore
        }
    }

    public function down(): void
    {
        Schema::table('product_pdf_pages', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }
};

