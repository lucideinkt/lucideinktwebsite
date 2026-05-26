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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert defaults
        DB::table('site_settings')->insert([
            ['key' => 'maintenance_mode',  'value' => '0',    'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mollie_mode',       'value' => 'test', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mail_driver',       'value' => 'smtp', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'debug_info',        'value' => '0',    'created_at' => now(), 'updated_at' => now()],
            ['key' => 'allow_indexing',    'value' => '0',    'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
