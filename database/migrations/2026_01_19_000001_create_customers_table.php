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
        Schema::create('customers', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Foreign key to users (if customer has account)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Billing address fields
            $table->string('billing_first_name');
            $table->string('billing_last_name');
            $table->string('billing_email');
            $table->string('billing_company')->nullable();
            $table->string('billing_street');
            $table->string('billing_house_number');
            $table->string('billing_house_number-add')->nullable();
            $table->string('billing_postal_code');
            $table->string('billing_city');
            $table->string('billing_country');
            $table->string('billing_phone')->nullable();

            // Timestamps & soft deletes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
