<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeds the pages of every book.
 *
 * Usage: php artisan db:seed --class=BooksSeeder
 */
class BooksSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AfwegingenNederlandsPagesSeeder::class);
        $this->call(BroederschapNederlandsPagesSeeder::class);
        $this->call(HerzamelingNederlandsPagesSeeder::class);
        $this->call(NatuurNederlandsPagesSeeder::class);
        $this->call(ZiekenNederlandsPagesSeeder::class);
    }
}
