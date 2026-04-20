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
        Schema::table('newsletter_subscribers', function (Blueprint $table) {
            $table->string('confirmation_token')->nullable()->unique()->after('token');
            // Change status enum to include 'pending'
            $table->enum('status', ['pending', 'subscribed', 'unsubscribed'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newsletter_subscribers', function (Blueprint $table) {
            $table->dropColumn('confirmation_token');
            $table->enum('status', ['subscribed', 'unsubscribed'])->default('subscribed')->change();
        });
    }
};
