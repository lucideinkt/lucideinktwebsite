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
        Schema::table('artikelen', function (Blueprint $table) {
            // Add body and show_featured_image columns which were added after the
            // initial artikelen table was created.
            if (!Schema::hasColumn('artikelen', 'body')) {
                $table->text('body')->nullable()->after('content');
            }
            if (!Schema::hasColumn('artikelen', 'show_featured_image')) {
                $table->boolean('show_featured_image')->default(true)->after('featured_image_alt');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
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
