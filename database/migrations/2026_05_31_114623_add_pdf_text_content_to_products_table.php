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
            $table->longText('pdf_text_content')->nullable()->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->after('pdf_reader_enabled');
            $table->timestamp('pdf_indexed_at')->nullable()->after('pdf_text_content');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'pdf_text_content')) {
                $table->dropColumn('pdf_text_content');
            }
            if (Schema::hasColumn('products', 'pdf_indexed_at')) {
                $table->dropColumn('pdf_indexed_at');
            }
        });
    }
};
