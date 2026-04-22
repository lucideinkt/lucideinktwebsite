<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('seo_description')->nullable()->after('long_description');
            $table->json('seo_tags')->nullable()->after('seo_description');
            $table->string('seo_author')->nullable()->after('seo_tags');
            $table->string('seo_robots')->nullable()->after('seo_author');
            $table->string('seo_canonical_url')->nullable()->after('seo_robots');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'seo_description',
                'seo_tags',
                'seo_author',
                'seo_robots',
                'seo_canonical_url',
            ]);
        });
    }
};
