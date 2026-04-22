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

        foreach ($this->pages() as $page) {
            if (! isset($page['page_number']) || ! isset($page['content'])) {
                continue;
            }

            BookPage::updateOrCreate(
                [
                    'product_id'  => $product->id,
                    'page_number' => $page['page_number'],
                ],
                [
                    'content'    => $page['content'],
                    'book_title' => $page['book_title'] ?? $this->bookTitle() ?? null,
                ]
            );
        }

        $this->command->info("Seeded " . count($this->pages()) . " page(s) for product: {$product->title}");
    }
}
