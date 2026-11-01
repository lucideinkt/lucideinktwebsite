<?php

namespace Tests\Unit;

use App\Services\BookHtmlValidator;
use App\Services\BookPageJsonSerializer;
use Database\Seeders\AfwegingenNederlandsPagesSeeder;
use Database\Seeders\BroederschapNederlandsPagesSeeder;
use Database\Seeders\CevsenPagesSeeder;
use Database\Seeders\HerzamelingNederlandsPagesSeeder;
use Database\Seeders\NatuurNederlandsPagesSeeder;
use Database\Seeders\ZiekenNederlandsPagesSeeder;
use PHPUnit\Framework\TestCase;

class BookPageSeedersValidationTest extends TestCase
{
    public function test_broederschap_page_112_keeps_each_footnote_with_its_own_arabic_citation(): void
    {
        $seeder = new BroederschapNederlandsPagesSeeder;
        $pages = (new \ReflectionClass($seeder))->getMethod('pages')->invoke($seeder);
        $source = array_values(array_filter($pages, fn ($page) => $page['page_number'] === 112))[0];
        $page = (new BookPageJsonSerializer)->serialize(112, $source['content']);
        $citations = [];
        $visit = function (array $nodes) use (&$visit, &$citations): void {
            foreach ($nodes as $node) {
                $refs = array_values(array_filter($node['children'] ?? [],
                    fn ($child) => $child['type'] === 'footnote_ref'));
                if (($node['language'] ?? null) === 'ar' && $refs) {
                    $citations[] = $node;
                }
                $visit($node['children'] ?? []);
            }
        };
        $visit($page['blocks']);
        $this->assertCount(2, $citations);
        foreach (['اِسْتَقِمْ كَمَٓا اُمِرْتَ ', 'وَلَا تَتَأَمَّرْ عَلَى سَيِّدِكَ '] as $index => $text) {
            $this->assertSame('rtl', $citations[$index]['direction']);
            $this->assertSame($text, $citations[$index]['children'][0]['text']);
            $this->assertSame('112:'.($index + 1), $citations[$index]['children'][1]['target']);
        }
        $this->assertSame(['112:1', '112:2', '112:3'], array_column($page['footnotes'], 'target'));
        $plain = function (array $nodes) use (&$plain): string {
            return implode('', array_map(fn ($node) => $node['text'] ?? $plain($node['children'] ?? []), $nodes));
        };
        $this->assertStringContainsString('Wees rechtdoorzee', $plain($page['footnotes'][0]['blocks']));
        $this->assertStringContainsString('Oefen geen zeggenschap', $plain($page['footnotes'][1]['blocks']));
    }

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
        $this->assertSame(100, mb_substr_count($content, "\u{06DD}"));
        $this->assertStringContainsString('<span class="cevsen-verse-number">۝١</span>', $pages[0]['content']);
        $this->assertSame(550, mb_substr_count($content, "\u{0656}"));
        $this->assertStringContainsString("عَظ\u{0656}يمُ", $content);
        $this->assertStringContainsString("حَك\u{0656}يمُ", $content);
        $this->assertStringNotContainsString("\u{2733}", $content);
        $this->assertStringNotContainsString("\u{066D}", $content);
        $this->assertSame(1021, substr_count($content, '<span class="cevsen-separator">۞</span>'));
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
