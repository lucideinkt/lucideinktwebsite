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
        Schema::table('products', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['created_by']);
            
            // Change the column from foreignId to string
            $table->string('created_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Change back to foreignId
            $table->foreignId('created_by')->nullable()->change();
            
            // Re-add the foreign key constraint
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }
};
