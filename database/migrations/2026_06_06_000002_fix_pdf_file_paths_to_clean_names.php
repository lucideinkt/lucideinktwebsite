<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * On production, PDFs were originally uploaded via the admin dashboard
     * and stored with random filenames. We have since uploaded clean-named
     * files to storage/app/public/pdfs/. This migration updates all pdf_file
     * paths to the clean names so the indexer and viewer can find the files.
     */
    public function up(): void
    {
        $updates = [
            1  => 'pdfs/afwegingen.pdf',
            3  => 'pdfs/broederschap.pdf',
            5  => 'pdfs/geloofswaarheden.pdf',
            6  => 'pdfs/herzameling.pdf',
            7  => 'pdfs/regathering.pdf',
            10 => 'pdfs/mirakelen.pdf',
            11 => 'pdfs/natuur.pdf',
            12 => 'pdfs/zieken.pdf',
            14 => 'pdfs/ramadan.pdf',
        ];

        foreach ($updates as $id => $path) {
            DB::table('products')->where('id', $id)->update([
                'pdf_file'    => $path,
                'pdf_indexed_at' => null, // force re-index
                'updated_at'  => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Cannot reliably restore random filenames — leave as-is on rollback
    }
};

