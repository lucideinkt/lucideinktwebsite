<?php

namespace Database\Seeders;

use App\Models\BookPage;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Base template for book page seeders.
 *
 * Usage:
 * - Create a new seeder that extends this class.
 * - Implement productSlug() to return the product slug.
 * - Optionally implement bookTitle() to provide a default book title for all pages.
 * - Implement pages() to return an array of page definitions.
 */
abstract class BookPagesSeeder extends Seeder
{
    /**
     * The slug of the product this seeder belongs to.
     */
    abstract protected function productSlug(): string;

    /**
     * Optional: the book title to use for pages when a page doesn't define its own 'book_title'.
     * Concrete seeders can override this to supply the title once.
     */
    protected function bookTitle(): ?string
    {
        return null;
    }

    /**
     * Return an array of pages. Each page must contain:
     * - page_number (int)
     * - content (string)
     * Optionally:
     * - book_title (string)
     *
     * @return array<int, array<string, mixed>>
     */
    abstract protected function pages(): array;

    public function run(): void
    {
        $product = Product::firstWhere('slug', $this->productSlug());

        if (! $product) {
            $this->command->warn("Product with slug [{$this->productSlug()}] not found. Skipping seeder: " . static::class);
            return;
        }

        $now = now();

        // Build the upsert rows and collect page numbers present in this seeder.
        $rows        = [];
        $pageNumbers = [];

        foreach ($this->pages() as $page) {
            if (! isset($page['page_number']) || ! isset($page['content'])) {
                continue;
            }

            $pageNumbers[] = (int) $page['page_number'];

            $rows[] = [
                'product_id'  => $product->id,
                'page_number' => (int) $page['page_number'],
                'content'     => $page['content'],
                'book_title'  => $page['book_title'] ?? $this->bookTitle() ?? null,
                'updated_at'  => $now,
                'created_at'  => $now,
            ];
        }

        if (empty($rows)) {
            $this->command->warn("No valid pages defined in " . static::class . ". Nothing seeded.");
            return;
        }

        // Upsert all pages in one query – always overwrites content & book_title.
        BookPage::upsert(
            $rows,
            ['product_id', 'page_number'],   // unique keys (requires the unique constraint)
            ['content', 'book_title', 'updated_at']  // columns to update on conflict
        );

        // Remove any pages that exist in the database but are no longer in this seeder.
        $deleted = BookPage::where('product_id', $product->id)
            ->whereNotIn('page_number', $pageNumbers)
            ->delete();

        $this->command->info(
            "Seeded " . count($rows) . " page(s) for product: {$product->title}" .
            ($deleted ? " | Removed {$deleted} stale page(s)." : '')
        );
    }
}
