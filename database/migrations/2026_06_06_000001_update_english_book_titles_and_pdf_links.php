<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ── Product 7: English edition of "Herzameling" ─────────────────────
        DB::table('products')->where('id', 7)->update([
            'title'             => 'Treatise on the Regathering - English',
            'slug'              => 'treatise-on-the-regathering-english',
            'short_description' => 'Has man come to this restless world to live a miserable life in the illusion of earthly happiness, only to disappear forever? Or is there more behind his existence than just the earthly, in which his human potential can never fully come into its own? Definitive answers to such crucial existential questions can be found in this valuable work.',
            'seo_title'         => 'Treatise on the Regathering | Lucide Inkt',
            'seo_description'   => 'Has man come to this restless world to live a miserable life in the illusion of earthly happiness, only to disappear forever? Discover definitive answers in this valuable work.',
            'pdf_file'          => 'pdfs/regathering.pdf',
            'pdf_reader_enabled'=> true,
            'updated_at'        => now(),
        ]);

        // ── Product 9: English-Turkish edition of "Herzameling" ─────────────
        DB::table('products')->where('id', 9)->update([
            'title'             => 'Treatise on the Regathering - English-Turkish',
            'slug'              => 'treatise-on-the-regathering-english-turkish',
            'short_description' => 'Has man come to this restless world to live a miserable life in the illusion of earthly happiness, only to disappear forever? Or is there more behind his existence than just the earthly, in which his human potential can never fully come into its own? Definitive answers to such crucial existential questions can be found in this valuable bilingual English-Turkish edition.',
            'seo_title'         => 'Treatise on the Regathering - English-Turkish | Lucide Inkt',
            'seo_description'   => 'Has man come to this restless world to live a miserable life in the illusion of earthly happiness, only to disappear forever? Discover definitive answers in this valuable bilingual English-Turkish work.',
            'updated_at'        => now(),
        ]);
    }

    public function down(): void
    {
        // Restore original Dutch titles
        DB::table('products')->where('id', 7)->update([
            'title'             => 'Het Traktaat over de Herzameling - Engels',
            'slug'              => 'het-traktaat-over-de-herzameling-engels',
            'short_description' => null,
            'seo_title'         => null,
            'seo_description'   => null,
            'pdf_file'          => null,
            'pdf_reader_enabled'=> false,
            'updated_at'        => now(),
        ]);

        DB::table('products')->where('id', 9)->update([
            'title'             => 'Het Traktaat over de Herzameling - Engels-Turks',
            'slug'              => 'het-traktaat-over-de-herzameling-engels-turks',
            'short_description' => null,
            'seo_title'         => null,
            'seo_description'   => null,
            'updated_at'        => now(),
        ]);
    }
};

