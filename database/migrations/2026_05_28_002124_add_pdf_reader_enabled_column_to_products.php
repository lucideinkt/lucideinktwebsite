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
        Schema::table('products', function (Blueprint $table) {
            // Guard: only add if the column doesn't exist yet
            // (local already has it via a manual DB change; production is missing it)
            if (!Schema::hasColumn('products', 'pdf_reader_enabled')) {
                $table->boolean('pdf_reader_enabled')->default(false)->after('book_content_published');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'pdf_reader_enabled')) {
                $table->dropColumn('pdf_reader_enabled');
            }
        });
    }
};
