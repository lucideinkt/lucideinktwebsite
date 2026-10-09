<?php

namespace Tests\Feature;

use App\Models\BookPage;
use App\Models\Product;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BookPagesApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('book_pages');
        Schema::dropIfExists('seo');
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->string('image_1')->nullable();
            $table->string('online_lezen_image')->nullable();
            $table->boolean('book_content_published')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('book_pages', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedSmallInteger('page_number');
            $table->longText('content')->nullable();
            $table->timestamps();
        });
        Schema::create('seo', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('model_id');
            $table->string('model_type');
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('book_pages');
        Schema::dropIfExists('seo');
        Schema::dropIfExists('products');

        parent::tearDown();
    }

    public function test_it_returns_paginated_structured_pages_for_a_published_book(): void
    {
        $product = Product::query()->create([
            'slug' => 'native-reader-book',
            'title' => 'Native Reader Book',
            'book_content_published' => true,
        ]);

        BookPage::create([
            'product_id' => $product->id,
            'page_number' => 5,
            'content' => '<div class="page" id="5"><p class="text-end page-number">#5</p><p>Tekst <sup>1</sup>.</p><div class="page-footnote"><p class="footnote-p"><sup>1</sup> Noot.</p></div></div>',
        ]);
        BookPage::create([
            'product_id' => $product->id,
            'page_number' => 6,
            'content' => '<div class="page" id="6"><p class="text-end page-number">#6</p><p>Volgende pagina.</p></div>',
        ]);

        $response = $this->getJson('/api/v1/books/native-reader-book/pages?after=0&limit=1');

        $response
            ->assertOk()
            ->assertJsonPath('schema_version', 1)
            ->assertJsonPath('book.slug', 'native-reader-book')
            ->assertJsonPath('pages.0.page_number', 5)
            ->assertJsonPath('pages.0.blocks.0.children.1.type', 'footnote_ref')
            ->assertJsonPath('pages.0.footnotes.0.blocks.0.children.0.text', 'Noot.')
            ->assertJsonPath('pagination.next_after', 5)
            ->assertJsonPath('pagination.has_more', true);

        $this->assertStringNotContainsString('data-html', $response->getContent());
    }

    public function test_it_hides_unpublished_book_content(): void
    {
        Product::query()->create([
            'slug' => 'unpublished-native-reader-book',
            'title' => 'Unpublished Native Reader Book',
            'book_content_published' => false,
        ]);

        $this->getJson('/api/v1/books/unpublished-native-reader-book/pages')
            ->assertNotFound();
    }

    public function test_it_validates_page_size(): void
    {
        $this->getJson('/api/v1/books/book/pages?limit=21')
            ->assertUnprocessable()
            ->assertJsonValidationErrors('limit');
    }

    public function test_navigation_returns_actual_page_numbers_and_shared_contents(): void
    {
        $book = Product::query()->create([
            'slug' => 'navigation-book',
            'title' => 'Navigation Book',
            'book_content_published' => true,
        ]);
        foreach ([12, 5, 8] as $number) {
            BookPage::create(['product_id' => $book->id, 'page_number' => $number, 'content' => '<p>Tekst</p>']);
        }
        $toc = [
            ['level' => 'main', 'title' => 'Hoofdstuk', 'subtitle' => 'Toelichting', 'page' => 5],
            ['level' => 'sub', 'title' => 'Onderdeel', 'subtitle' => null, 'page' => 8],
        ];
        config(['book_toc.navigation-book' => $toc]);

        $this->getJson('/api/v1/books/navigation-book/navigation')
            ->assertOk()
            ->assertJsonPath('schema_version', 1)
            ->assertJsonPath('book.slug', 'navigation-book')
            ->assertJsonPath('page_numbers', [5, 8, 12])
            ->assertJsonPath('toc', $toc);
    }

    public function test_navigation_without_configured_contents_returns_an_empty_list(): void
    {
        $book = Product::query()->create([
            'slug' => 'no-contents-book',
            'title' => 'No Contents',
            'book_content_published' => true,
        ]);
        BookPage::create(['product_id' => $book->id, 'page_number' => 5, 'content' => '<p>Tekst</p>']);
        $this->getJson('/api/v1/books/no-contents-book/navigation')
            ->assertOk()
            ->assertJsonPath('page_numbers', [5])
            ->assertJsonPath('toc', []);
    }

    public function test_navigation_hides_unpublished_missing_and_empty_books(): void
    {
        Product::query()->create([
            'slug' => 'empty-book', 'title' => 'Empty Book', 'book_content_published' => true,
        ]);
        Product::query()->create([
            'slug' => 'private-book', 'title' => 'Private Book', 'book_content_published' => false,
        ]);
        foreach (['empty-book', 'private-book', 'missing-book'] as $slug) {
            $this->getJson('/api/v1/books/'.$slug.'/navigation')->assertNotFound();
        }
    }

    public function test_native_search_returns_hits_on_pages_outside_the_first_batch(): void
    {
        $book = Product::query()->create([
            'slug' => 'search-book', 'title' => 'Search Book', 'book_content_published' => true,
        ]);
        BookPage::create(['product_id' => $book->id, 'page_number' => 80, 'content' => '<p>Bediüzzaman Nursî en het geloof.</p>']);
        $this->getJson('/api/v1/books/search-book/search?q=Nursi')
            ->assertOk()->assertJsonPath('results.0.page', 80)->assertJsonPath('total', 1);
        $this->getJson('/api/v1/books/search-book/search?q=onvindbaar')
            ->assertOk()->assertJsonPath('results', []);
        $book->update(['book_content_published' => false]);
        $this->getJson('/api/v1/books/search-book/search?q=geloof')->assertNotFound();
    }

    public function test_native_search_validates_query_length(): void
    {
        $this->getJson('/api/v1/books/book/search?q=a')->assertUnprocessable()->assertJsonValidationErrors('q');
        $this->getJson('/api/v1/books/book/search?q='.str_repeat('a', 201))->assertUnprocessable()->assertJsonValidationErrors('q');
    }

    public function test_all_books_search_returns_hits_per_published_book(): void
    {
        $first = Product::query()->create(['slug' => 'eerste', 'title' => 'Eerste', 'book_content_published' => true]);
        $second = Product::query()->create(['slug' => 'tweede', 'title' => 'Tweede', 'book_content_published' => true]);
        $hidden = Product::query()->create(['slug' => 'verborgen', 'title' => 'Verborgen', 'book_content_published' => false]);
        BookPage::create(['product_id' => $first->id, 'page_number' => 12, 'content' => '<p>Bediüzzaman Nursî en het geloof.</p>']);
        BookPage::create(['product_id' => $second->id, 'page_number' => 3, 'content' => '<p>Over het geloof.</p>']);
        BookPage::create(['product_id' => $hidden->id, 'page_number' => 1, 'content' => '<p>Geloof.</p>']);

        $this->getJson('/api/v1/search?q=geloof')
            ->assertOk()
            ->assertJsonPath('total', 2)
            ->assertJsonPath('results.0.slug', 'eerste')
            ->assertJsonPath('results.0.title', 'Eerste')
            ->assertJsonPath('results.0.page', 12)
            ->assertJsonPath('results.1.slug', 'tweede');
        $this->getJson('/api/v1/search?q=Nursi')->assertOk()->assertJsonPath('results.0.snippet', 'Bediüzzaman [[HIT]]Nursî[[/HIT]] en het geloof.');
        $this->getJson('/api/v1/search?q=a')->assertUnprocessable()->assertJsonValidationErrors('q');
    }

    public function test_catalog_lists_newly_published_books_with_reader_metadata(): void
    {
        $book = Product::query()->create([
            'slug' => 'new-native-reader-book',
            'title' => 'New Native Reader Book',
            'short_description' => 'A short book description.',
            'online_lezen_image' => 'images/native-cover.png',
            'book_content_published' => true,
        ]);
        BookPage::create([
            'product_id' => $book->id,
            'page_number' => 1,
            'content' => '<div class="page" id="1"><p>Content</p></div>',
        ]);
        $secondBook = Product::query()->create([
            'slug' => 'another-native-reader-book',
            'title' => 'Another Native Reader Book',
            'book_content_published' => true,
        ]);
        BookPage::create([
            'product_id' => $secondBook->id,
            'page_number' => 1,
            'content' => '<div class="page" id="1"><p>More content</p></div>',
        ]);
        $unpublishedBook = Product::query()->create([
            'slug' => 'unpublished-catalog-book',
            'title' => 'Unpublished Catalog Book',
            'book_content_published' => false,
        ]);
        BookPage::create([
            'product_id' => $unpublishedBook->id,
            'page_number' => 1,
            'content' => '<div class="page" id="1"><p>Hidden content</p></div>',
        ]);
        Product::query()->create([
            'slug' => 'book-without-pages',
            'title' => 'Book Without Pages',
            'book_content_published' => true,
        ]);

        $this->getJson('/api/v1/books?limit=10')
            ->assertOk()
            ->assertJsonPath('schema_version', 1)
            ->assertJsonPath('books.0.slug', 'another-native-reader-book')
            ->assertJsonPath('books.1.slug', 'new-native-reader-book')
            ->assertJsonPath('books.1.title', 'New Native Reader Book')
            ->assertJsonPath('books.1.description', 'A short book description.')
            ->assertJsonPath('books.1.cover_image', secure_url('images/native-cover.png'))
            ->assertJsonPath('books.1.page_count', 1)
            ->assertJsonPath('books.1.pages_url', route('api.v1.books.pages.index', ['slug' => 'new-native-reader-book']))
            ->assertJsonPath('pagination.total', 2)
            ->assertJsonPath('pagination.has_more', false);

        $this->getJson('/api/v1/books?page=1&limit=1')
            ->assertOk()
            ->assertJsonPath('books.0.slug', 'another-native-reader-book')
            ->assertJsonPath('pagination.has_more', true);

        $this->getJson('/api/v1/books?page=2&limit=1')
            ->assertOk()
            ->assertJsonPath('books.0.slug', 'new-native-reader-book')
            ->assertJsonPath('pagination.page', 2)
            ->assertJsonPath('pagination.has_more', false);
    }

    public function test_catalog_validates_page_size(): void
    {
        $this->getJson('/api/v1/books?limit=51')
            ->assertUnprocessable()
            ->assertJsonValidationErrors('limit');
    }
}
