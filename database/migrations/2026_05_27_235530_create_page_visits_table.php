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
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->string('url', 1000);
            $table->string('route_name')->nullable();
            $table->string('page_type')->nullable();
            $table->string('page_title')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('ip_hash', 64)->nullable();
            $table->string('session_hash', 64)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referer', 1000)->nullable();
            $table->string('device_type', 20)->nullable();
            $table->timestamps();

            $table->index('page_type');
            $table->index('route_name');
            $table->index('product_id');
            $table->index('created_at');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
