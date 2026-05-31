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
        Schema::table('product_pdf_pages', function (Blueprint $table) {
            if (!Schema::hasColumn('product_pdf_pages', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('id');
            }
            if (!Schema::hasColumn('product_pdf_pages', 'page_number')) {
                $table->unsignedInteger('page_number')->after('product_id');
            }
            if (!Schema::hasColumn('product_pdf_pages', 'content')) {
                $table->longText('content')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->after('page_number');
            }
        });

        // Add unique index if not present yet
        try {
            Schema::table('product_pdf_pages', function (Blueprint $table) {
                $table->unique(['product_id', 'page_number'], 'product_pdf_pages_product_id_page_number_unique');
            });
        } catch (\Throwable $e) {
            // Index already exists — safe to ignore
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_pdf_pages', function (Blueprint $table) {
            $table->dropColumn(['product_id', 'page_number', 'content']);
        });
    }
};
