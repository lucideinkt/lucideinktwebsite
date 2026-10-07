<?php

namespace Tests\Unit;

use App\Services\BookHtmlValidator;
use Database\Seeders\AfwegingenNederlandsPagesSeeder;
use Database\Seeders\BroederschapNederlandsPagesSeeder;
use Database\Seeders\HerzamelingNederlandsPagesSeeder;
use Database\Seeders\NatuurNederlandsPagesSeeder;
use Database\Seeders\ZiekenNederlandsPagesSeeder;
use PHPUnit\Framework\TestCase;

class BookPageSeedersValidationTest extends TestCase
{
    public function test_book_page_seeders_have_no_unresolved_validation_findings(): void
    {
        $seederClasses = [
            AfwegingenNederlandsPagesSeeder::class,
            BroederschapNederlandsPagesSeeder::class,
            HerzamelingNederlandsPagesSeeder::class,
            NatuurNederlandsPagesSeeder::class,
            ZiekenNederlandsPagesSeeder::class,
        ];
        $validator = new BookHtmlValidator;
        $definitionsChecked = 0;
        $remainingFindings = [];

        foreach ($seederClasses as $seederClass) {
            $seeder = new $seederClass;
            $reflection = new \ReflectionClass($seeder);
            $pagesMethod = $reflection->getMethod('pages');
            $pagesMethod->setAccessible(true);
            $pages = $pagesMethod->invoke($seeder);
            $pageNumbers = [];

            foreach ($pages as $page) {
                $definitionsChecked++;
                $pageNumber = (int) $page['page_number'];
                $pageNumbers[] = $pageNumber;

                $this->assertStringNotContainsString(
                    'data-html=',
                    $page['content'],
                    "{$seederClass} page {$pageNumber} stores footnote text in a reference attribute."
                );
                $this->assertSame(
                    0,
                    preg_match('/<button\b[^>]*class="[^"]*\bfn-ref\b/i', $page['content']),
                    "{$seederClass} page {$pageNumber} stores a rendered footnote button in source content."
                );

                foreach ($validator->validatePageHtml($page['content'], $pageNumber) as $finding) {
                    $remainingFindings[] = [
                        'seeder' => $seederClass,
                        'page' => $pageNumber,
                        'code' => $finding['code'],
                    ];
                }
            }

            $this->assertSame(
                count($pageNumbers),
                count(array_unique($pageNumbers)),
                "{$seederClass} defines a page number more than once."
            );
        }

        $this->assertSame(605, $definitionsChecked);
        $this->assertSame([], $remainingFindings);
    }
}
