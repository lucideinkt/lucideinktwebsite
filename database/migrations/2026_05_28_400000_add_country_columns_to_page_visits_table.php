<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_visits', function (Blueprint $table) {
            if (! Schema::hasColumn('page_visits', 'country_code')) {
                $table->string('country_code', 2)->nullable()->after('device_type');
            }
            if (! Schema::hasColumn('page_visits', 'country')) {
                $table->string('country', 100)->nullable()->after('country_code');
            }
            if (! Schema::hasColumn('page_visits', 'city')) {
                $table->string('city', 100)->nullable()->after('country');
            }
        });
    }

    public function down(): void
    {
        Schema::table('page_visits', function (Blueprint $table) {
            $table->dropColumn(array_filter([
                Schema::hasColumn('page_visits', 'country_code') ? 'country_code' : null,
                Schema::hasColumn('page_visits', 'country')      ? 'country'      : null,
                Schema::hasColumn('page_visits', 'city')         ? 'city'         : null,
            ]));
        });
    }
};

