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
            $table->unsignedSmallInteger('title_max_width')->nullable()->after('sort_order'); // px, null = default 800
        });
    }

    public function down(): void
    {
        Schema::table('artikelen', function (Blueprint $table) {
            $table->dropColumn('title_max_width');
        });
    }
};
