<?php

namespace App\Console\Commands;

use App\Models\BookPage;
use App\Services\BookHtmlValidator;
use Illuminate\Console\Command;

class ValidateBookHtml extends Command
{
    protected $signature = 'books:validate-html
                            {--product= : Only validate pages belonging to a product ID}';

    protected $description = 'Report structural issues in stored book page HTML without modifying content';

    public function handle(BookHtmlValidator $validator): int
    {
        $query = BookPage::query()
            ->with('product:id,title')
            ->orderBy('product_id')
            ->orderBy('page_number');

        if ($productId = $this->option('product')) {
            $query->where('product_id', $productId);
        }

        $pageCount = 0;
        $findingCounts = [];
        $examples = [];

        $query->chunk(100, function ($pages) use ($validator, &$pageCount, &$findingCounts, &$examples): void {
            foreach ($pages as $page) {
                $pageCount++;
                $findings = $validator->validatePageHtml($page->content, (int) $page->page_number);

                foreach ($findings as $finding) {
                    $code = $finding['code'];
                    $findingCounts[$code] = ($findingCounts[$code] ?? 0) + 1;

                    if (count($examples[$code] ?? []) < 5) {
                        $examples[$code][] = [
                            $page->product?->title ?? "Product {$page->product_id}",
                            $page->page_number,
                            $finding['severity'],
                        ];
                    }
                }
            }
        });

        $this->info("Validated {$pageCount} stored book page(s). No content was changed.");

        if ($findingCounts === []) {
            $this->info('No findings.');

            return self::SUCCESS;
        }

        ksort($findingCounts);
        $rows = [];

        foreach ($findingCounts as $code => $count) {
            $samplePages = collect($examples[$code] ?? [])
                ->map(fn (array $example) => "{$example[0]} p.{$example[1]} ({$example[2]})")
                ->implode('; ');

            $rows[] = [$code, $count, $samplePages];
        }

        $this->table(['Finding', 'Count', 'Sample pages (up to 5)'], $rows);
        $this->line('Footnote references without a local note may be intentional continuations and require manual review.');

        return self::SUCCESS;
    }
}
