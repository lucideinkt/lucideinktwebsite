<?php

namespace Tests\Unit;

use App\Services\BookHtmlValidator;
use App\Services\BookPageJsonSerializer;
use Database\Seeders\AfwegingenNederlandsPagesSeeder;
use Database\Seeders\BroederschapNederlandsPagesSeeder;
use Database\Seeders\CevsenPagesSeeder;
use Database\Seeders\HerzamelingNederlandsPagesSeeder;
use Database\Seeders\NatuurNederlandsPagesSeeder;
use Database\Seeders\TesbihatPagesSeeder;
use Database\Seeders\ZiekenNederlandsPagesSeeder;
use PHPUnit\Framework\TestCase;

class BookPageSeedersValidationTest extends TestCase
{
    public function test_tesbihat_contents_links_four_sections_per_prayer_to_existing_anchors(): void
    {
        $toc = (require __DIR__.'/../../config/book_toc.php')['namaz-tesbihati'];
        $seeder = new TesbihatPagesSeeder;
        $pages = (new \ReflectionClass($seeder))->getMethod('pages')->invoke($seeder);
        $this->assertCount(62, $pages);
        $this->assertSame(range(1, 62), array_column($pages, 'page_number'));
        $this->assertCount(25, $toc);
        $anchors = [];
        $serializer = new BookPageJsonSerializer;
        $mainEntries = array_values(array_filter($toc, fn ($entry) => $entry['level'] === 'main'));
        $this->assertSame([1, 17, 27, 41, 53], array_column($mainEntries, 'page'));
        foreach ($mainEntries as $index => $main) {
            $entries = array_slice($toc, $index * 5, 5);
            $this->assertSame(['main', 'sub', 'sub', 'sub', 'sub'], array_column($entries, 'level'));
            $lastPage = $main['page'];
            $nextPrayerPage = $mainEntries[$index + 1]['page'] ?? 63;
            foreach (array_slice($entries, 1) as $entry) {
                $this->assertGreaterThan($lastPage, $entry['page']);
                $this->assertLessThan($nextPrayerPage, $entry['page']);
                $lastPage = $entry['page'];
                $page = $pages[$entry['page'] - 1];
                $document = new \DOMDocument;
                $document->loadHTML('<?xml encoding="UTF-8">'.$page['content']);
                $xpath = new \DOMXPath($document);
                $anchor = $entry['anchor'];
                $anchors[] = $anchor;
                $nodes = $xpath->query('//*[@id="'.$anchor.'"]');
                $this->assertCount(1, $nodes);
                $this->assertSame('p', $nodes[0]->tagName);
                $json = $serializer->serialize($entry['page'], $page['content']);
                $this->assertContains($anchor, array_column($json['blocks'], 'anchor'));
                $expectedText = match (true) {
                    str_ends_with($anchor, '-na-smeekbede') => '33 keer:',
                    str_ends_with($anchor, '-namen') => $entry['title'],
                    str_ends_with($anchor, '-slotgebed') => 'Open je handen',
                    default => str_replace('Soera ', '', $entry['title']),
                };
                $this->assertStringContainsString($expectedText, $nodes[0]->textContent);
            }
        }
        $this->assertCount(20, array_unique($anchors));
    }

    public function test_tesbihat_pagination_preserves_every_prayer_and_bounds_page_lengths(): void
    {
        $seeder = new TesbihatPagesSeeder;
        $pages = (new \ReflectionClass($seeder))->getMethod('pages')->invoke($seeder);
        $checksums = [
            [1, 16, '9cf3aecc13579db0ae9a13c6cb5a553a80e9384e1e4472db2a76d4b461aec959'],
            [17, 26, '44a78a501c6927e164e0bf37c30ba7fdcb9757636abeec551d6a6f3722d80cf7'],
            [27, 40, '97497d3de2140e4ae8388c4ddfbfd1cea0e4cc3996156b7a2dd1c4b304f436aa'],
            [41, 52, '91a53934274773b55ce786f48c14eed9d8e0c434adeeade41757bf6713c9ca1d'],
            [53, 62, 'dbf52f9bc3ed50ea23c45c388cbd74edf298ba2672aa6194a94f22efb205eded'],
        ];
        $textByPage = [];
        $validator = new BookHtmlValidator;
        foreach ($pages as $page) {
            $number = $page['page_number'];
            $this->assertStringContainsString('<div class="page" id="'.$number.'">', $page['content']);
            $this->assertStringContainsString('<p class="text-end page-number">#'.$number.'</p>', $page['content']);
            $body = preg_replace('~<p class="text-end page-number">.*?</p>~u', '', $page['content']);
            $textByPage[$number] = preg_replace('/\s+/u', '', strip_tags($body));
            $length = mb_strlen(preg_replace('/\p{M}/u', '', strip_tags($body)));
            $this->assertGreaterThan(150, $length, 'Page '.$number.' is too short.');
            $this->assertLessThanOrEqual(1100, $length, 'Page '.$number.' is too long.');
            $this->assertSame([], $validator->validatePageHtml($page['content'], $number), 'Invalid page '.$number);
        }
        foreach ($checksums as [$start, $end, $checksum]) {
            $text = implode('', array_intersect_key($textByPage, array_flip(range($start, $end))));
            $this->assertSame($checksum, hash('sha256', $text), 'Prayer starting on page '.$start.' changed.');
        }
        $naba = array_filter($pages, fn ($page) => $page['page_number'] >= 39 && $page['page_number'] <= 40);
        $this->assertSame(40, substr_count(implode('', array_column($naba, 'content')), 'cevsen-verse-number'));
    }

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
