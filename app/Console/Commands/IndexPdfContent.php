<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\PdfIndexService;
use Illuminate\Console\Command;

class IndexPdfContent extends Command
{
    protected $signature = 'pdf:index
                            {--force : Re-index all PDFs, even already-indexed ones}
                            {--product= : Only index a specific product ID}';

    protected $description = 'Extract and index text content from product PDF files for search';

    public function handle(PdfIndexService $service): int
    {
        // Ensure enough memory for large PDFs
        ini_set('memory_limit', '512M');

        $query = Product::whereNotNull('pdf_file')->where('pdf_file', '!=', '');

        if ($id = $this->option('product')) {
            $query->where('id', $id);
        } elseif (!$this->option('force')) {
            $query->whereNull('pdf_indexed_at');
        }

        $products = $query->get(['id', 'title', 'pdf_file']);

        if ($products->isEmpty()) {
            $this->info('No PDFs to index. Use --force to re-index all.');
            return self::SUCCESS;
        }

        $this->info("Memory limit: " . ini_get('memory_limit') . " | Storage public root: " . storage_path('app/public'));
        $this->info("Indexing {$products->count()} PDF(s)...");
        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $ok = 0;
        $fail = 0;

        foreach ($products as $product) {
            $result = $service->indexProduct($product, $this);
            $result ? $ok++ : $fail++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Done. Indexed: {$ok} | Failed/Empty: {$fail}");

        return self::SUCCESS;
    }
}
