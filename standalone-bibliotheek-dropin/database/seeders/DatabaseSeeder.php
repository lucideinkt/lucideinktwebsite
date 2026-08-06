<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Afwegingen van Geloof & Ongeloof - Nederlands',
                'slug' => 'afwegingen-van-geloof-ongeloof-nederlands',
                'online_lezen_image' => 'images/books/leesbuttons/lees_afwegingen_btn.webp',
                'image_1' => 'images/books/afwegingen/afwegingen_nl_front.webp',
            ],
            [
                'title' => 'Het Traktaat over de Herzameling - Nederlands',
                'slug' => 'het-traktaat-over-de-herzameling-nederlands',
                'online_lezen_image' => 'images/books/leesbuttons/lees_herzameling_btn.webp',
                'image_1' => 'images/books/herzameling/herzameling-nl-front.webp',
            ],
            [
                'title' => 'Het Traktaat over de Natuur - Nederlands',
                'slug' => 'het-traktaat-over-de-natuur-nederlands',
                'online_lezen_image' => 'images/books/leesbuttons/lees_natuur_btn.webp',
                'image_1' => 'images/books/natuur/natuur-nl-front.webp',
            ],
            [
                'title' => 'Het Traktaat Voor de Zieken - Nederlands',
                'slug' => 'het-traktaat-voor-de-zieken-nederlands',
                'online_lezen_image' => 'images/books/leesbuttons/lees_zieken_btn.webp',
                'image_1' => 'images/books/zieken/zieken-nl-front.webp',
            ],
            [
                'title' => 'Broederschap & Oprechtheid - Nederlands',
                'slug' => 'broederschap-oprechtheid-nederlands',
                'online_lezen_image' => 'images/books/leesbuttons/lees_broederschap_btn.webp',
                'image_1' => 'images/books/broederschap/broederschap_nl_front.webp',
            ],
        ];

        foreach ($books as $book) {
            Product::updateOrCreate(
                ['slug' => $book['slug']],
                [
                    'title' => $book['title'],
                    'short_description' => '',
                    'price' => 0,
                    'stock' => 0,
                    'is_published' => true,
                    'book_content_published' => true,
                    'pdf_reader_enabled' => false,
                    'pdf_file' => null,
                    'online_lezen_image' => $book['online_lezen_image'],
                    'image_1' => $book['image_1'],
                ]
            );
        }

        $this->call([
            AfwegingenNederlandsPagesSeeder::class,
            HerzamelingNederlandsPagesSeeder::class,
            NatuurNederlandsPagesSeeder::class,
            ZiekenNederlandsPagesSeeder::class,
            BroederschapNederlandsPagesSeeder::class,
        ]);
    }
}

