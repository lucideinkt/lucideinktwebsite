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
            if (!Schema::hasColumn('products', 'seo_title_online')) {
                $table->string('seo_title_online')->nullable()->after('seo_title');
            }
            if (!Schema::hasColumn('products', 'seo_description_online')) {
                $table->text('seo_description_online')->nullable()->after('seo_description');
            }
            if (!Schema::hasColumn('products', 'seo_robots_online')) {
                $table->string('seo_robots_online', 100)->nullable()->after('seo_robots');
            }
            if (!Schema::hasColumn('products', 'seo_canonical_url_online')) {
                $table->string('seo_canonical_url_online', 500)->nullable()->after('seo_canonical_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $cols = ['seo_title_online', 'seo_description_online', 'seo_robots_online', 'seo_canonical_url_online'];
            $existing = array_filter($cols, fn($c) => Schema::hasColumn('products', $c));
            if ($existing) {
                $table->dropColumn(array_values($existing));
            }
        });
    }
};
