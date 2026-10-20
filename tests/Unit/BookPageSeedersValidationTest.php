<?php

namespace Tests\Unit;

use App\Services\BookHtmlValidator;
use Database\Seeders\AfwegingenNederlandsPagesSeeder;
use Database\Seeders\BroederschapNederlandsPagesSeeder;
use Database\Seeders\CevsenPagesSeeder;
use Database\Seeders\HerzamelingNederlandsPagesSeeder;
use Database\Seeders\NatuurNederlandsPagesSeeder;
use Database\Seeders\ZiekenNederlandsPagesSeeder;
use PHPUnit\Framework\TestCase;

class BookPageSeedersValidationTest extends TestCase
{
    public function test_cevsen_table_of_contents_links_every_ukde_to_its_page(): void
    {
        $toc = (require __DIR__.'/../../config/book_toc.php')['cevsen-ul-kebir'];
        $seeder = new CevsenPagesSeeder;
        $pages = (new \ReflectionClass($seeder))->getMethod('pages')->invoke($seeder);

        $this->assertCount(100, $toc);
        $this->assertSame(array_column($pages, 'page_number'), array_column($toc, 'page'));

        foreach ($toc as $index => $entry) {
            $this->assertSame([
                'level' => 'main',
                'title' => ($index + 1).'. ukde',
                'subtitle' => null,
                'page' => $index + 1,
            ], $entry);
        }
    }

    public function test_cevsen_uses_subscript_alef_instead_of_low_stop_marks(): void
    {
        $seeder = new CevsenPagesSeeder;
        $pagesMethod = (new \ReflectionClass($seeder))->getMethod('pages');
        $pages = $pagesMethod->invoke($seeder);
        $content = implode('', array_column($pages, 'content'));

        $this->assertCount(100, $pages);
        $this->assertStringNotContainsString('<h2>Cevşen-ül Kebir</h2>', $pages[0]['content']);
        $this->assertStringNotContainsString("\u{06EA}", $content);
        $this->assertSame(550, mb_substr_count($content, "\u{0656}"));
        $this->assertStringContainsString("عَظ\u{0656}يمُ", $content);
        $this->assertStringContainsString("حَك\u{0656}يمُ", $content);
        $this->assertStringNotContainsString("\u{2733}", $content);
        $this->assertStringNotContainsString("\u{066D}", $content);
        $this->assertSame(1021, substr_count($content, '<span class="cevsen-separator">*</span>'));
    }

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
