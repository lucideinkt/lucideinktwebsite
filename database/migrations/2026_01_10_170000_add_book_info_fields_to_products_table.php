<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('pages')->nullable()->after('depth');
            $table->string('binding_type')->nullable()->after('pages'); // hardcover, softcover
            $table->string('ean_code')->nullable()->after('binding_type');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'pages',
                'binding_type',
                'ean_code',
            ]);
        });
    }
};
