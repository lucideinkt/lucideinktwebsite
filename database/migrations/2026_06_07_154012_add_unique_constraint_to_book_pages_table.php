<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Remove duplicate rows – keep the row with the highest id
        // (most recently inserted) for each (product_id, page_number) pair.
        DB::statement('
            DELETE bp1
            FROM book_pages bp1
            INNER JOIN book_pages bp2
                ON  bp1.product_id  = bp2.product_id
                AND bp1.page_number = bp2.page_number
                AND bp1.id          < bp2.id
        ');

        Schema::table('book_pages', function (Blueprint $table) {
            // Step 2: Add the unique constraint FIRST.
            // MySQL will accept this even while the old plain index still exists.
            // The unique index itself satisfies the FK requirement, so MySQL will
            // allow us to drop the old plain index afterwards.
            $table->unique(['product_id', 'page_number'], 'book_pages_product_page_unique');

            // Step 3: Drop the old non-unique index.
            // At this point the unique index already covers the FK requirement,
            // so MySQL allows the drop.
            $table->dropIndex('book_pages_product_id_page_number_index');
        });
    }

    public function down(): void
    {
        Schema::table('book_pages', function (Blueprint $table) {
            // Restore the plain index before dropping the unique one (FK safety).
            $table->index(['product_id', 'page_number']);
            $table->dropUnique('book_pages_product_page_unique');
        });
    }
};
