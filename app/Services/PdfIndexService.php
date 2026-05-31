<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductPdfPage;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class PdfIndexService
{
    /**
     * Extract text from a PDF file path (relative to public storage disk)
     * and return it as a plain string.
     */
    public function extractText(string $pdfPath): ?string
    {
        $absolutePath = Storage::disk('public')->path($pdfPath);

        if (!file_exists($absolutePath)) {
            return null;
        }

        try {
            $config = new \Smalot\PdfParser\Config();
            $config->setRetainImageContent(false);

            $parser = new Parser([], $config);
            $pdf    = $parser->parseFile($absolutePath);
            $text   = $pdf->getText();

            // Normalize whitespace
            $text = preg_replace('/\s+/', ' ', $text);
            $text = trim($text);

            // Ensure valid UTF-8 and strip characters that may cause DB issues
            $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
            // Remove null bytes
            $text = str_replace("\0", '', $text);

            return $text ?: null;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning("PdfIndexService: failed to parse [{$pdfPath}]: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Index a single product: extract PDF text per page and store them.
     * Also stores the full text on the product for fallback.
     *
     * @param \Illuminate\Console\Command|null $output  Optional console for debug output
     */
    public function indexProduct(Product $product, $output = null): bool
    {
        if (empty($product->pdf_file)) {
            $output?->line("  <comment>SKIP</comment>  [{$product->title}] – no pdf_file set");
            return false;
        }

        $absolutePath = Storage::disk('public')->path($product->pdf_file);

        if (!file_exists($absolutePath)) {
            // Fallback: try public_path
            $fallback = public_path($product->pdf_file);
            if (file_exists($fallback)) {
                $absolutePath = $fallback;
                $output?->line("  <comment>INFO</comment>  [{$product->title}] – using public_path fallback");
            } else {
                $output?->line("  <error>FAIL</error>  [{$product->title}] – file not found at:\n    {$absolutePath}\n    {$fallback}");
                return false;
            }
        }

        try {
            $config = new \Smalot\PdfParser\Config();
            $config->setRetainImageContent(false);

            $parser = new Parser([], $config);
            $pdf    = $parser->parseFile($absolutePath);
            $pages  = $pdf->getPages();
            ProductPdfPage::where('product_id', $product->id)->delete();

            $fullText = '';
            $upserts  = [];
            $pageCount = 0;

            foreach ($pages as $i => $page) {
                $pageNumber = $i + 1;
                $pageCount++;
                try {
                    $text = $page->getText();
                } catch (\Throwable $e) {
                    $text = '';
                }

                // Sanitize
                $text = preg_replace('/\s+/', ' ', $text ?? '');
                $text = trim($text);
                $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
                $text = str_replace("\0", '', $text);

                $fullText .= ' ' . $text;

                if ($text !== '') {
                    $upserts[] = [
                        'product_id'  => $product->id,
                        'page_number' => $pageNumber,
                        'content'     => $text,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ];
                }

                // Insert in batches of 50 to avoid memory issues
                if (count($upserts) >= 50) {
                    ProductPdfPage::upsert($upserts, ['product_id', 'page_number'], ['content', 'updated_at']);
                    $upserts = [];
                }
            }

            // Flush remaining
            if (!empty($upserts)) {
                ProductPdfPage::upsert($upserts, ['product_id', 'page_number'], ['content', 'updated_at']);
            }

            // Update full-text on product
            $fullText = preg_replace('/\s+/', ' ', trim($fullText));
            $fullText = mb_convert_encoding($fullText, 'UTF-8', 'UTF-8');
            $fullText = str_replace("\0", '', $fullText);

            $product->updateQuietly([
                'pdf_text_content' => $fullText ?: null,
                'pdf_indexed_at'   => now(),
            ]);

            return $pageCount > 0;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning("PdfIndexService: failed to index [{$product->pdf_file}]: " . $e->getMessage());
            $output?->line("  <error>FAIL</error>  [{$product->title}] – " . $e->getMessage());
            return false;
        }
    }
}


