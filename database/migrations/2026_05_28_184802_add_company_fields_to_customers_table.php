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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('kvk_nummer')->nullable()->after('billing_company');
            $table->string('rsin_nummer')->nullable()->after('kvk_nummer');
            $table->string('btw_nummer')->nullable()->after('rsin_nummer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['kvk_nummer', 'rsin_nummer', 'btw_nummer']);
        });
    }
};
