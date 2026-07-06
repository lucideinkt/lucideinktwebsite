<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The original migration (2026_07_04_114308_add_body_and_show_featured_image_to_artikelen_table)
 * was already marked as "ran" in the migrations table before its logic was finalized, so it
 * never actually added these columns on some environments (e.g. production).
 *
 * This migration is idempotent (checks column existence) and safe to run anywhere,
 * guaranteeing the columns finally get added where they are missing.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artikelen', function (Blueprint $table) {
            if (!Schema::hasColumn('artikelen', 'body')) {
                $table->text('body')->nullable()->after('content');
            }
            if (!Schema::hasColumn('artikelen', 'show_featured_image')) {
                $table->boolean('show_featured_image')->default(true)->after('featured_image_alt');
            }
        });
    }

    public function down(): void
    {
        Schema::table('artikelen', function (Blueprint $table) {
            if (Schema::hasColumn('artikelen', 'show_featured_image')) {
                $table->dropColumn('show_featured_image');
            }
            if (Schema::hasColumn('artikelen', 'body')) {
                $table->dropColumn('body');
            }
        });
    }
};

