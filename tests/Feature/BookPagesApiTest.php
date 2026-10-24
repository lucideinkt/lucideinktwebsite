<?php

namespace Tests\Feature;

use App\Http\Controllers\BookContentController;
use App\Models\BookPage;
use App\Models\Product;
use App\Services\BookContentVersion;
use Database\Seeders\CevsenPagesSeeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
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
            $table->boolean('is_published')->default(false);
            $table->integer('stock')->default(0);
            $table->text('short_description')->nullable();
            $table->string('image_1')->nullable();
            $table->string('online_lezen_image')->nullable();
            $table->string('book_content_cover')->nullable();
            $table->string('book_content_language', 2)->nullable();
            $table->string('book_content_type', 20)->nullable();
            $table->boolean('book_content_published')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('book_pages', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedSmallInteger('page_number');
            $table->longText('content')->nullable();
            $table->string('book_title')->nullable();
            $table->timestamps();
            $table->unique(['product_id', 'page_number'], 'book_pages_product_page_unique');
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

    public function test_library_covers_support_html_and_enabled_pdf_books(): void
    {
        $cases = [
            [0, false, 'books/example.pdf', true, false, true],
            [0, false, 'books/example.pdf', true, true, true],
            [0, false, 'books/example.pdf', false, false, false],
            [0, true, 'books/example.pdf', false, false, false],
            [0, false, null, true, false, false],
            [1, true, null, false, false, true],
            [1, false, null, false, true, false],
            [1, false, 'books/example.pdf', true, false, true],
        ];

        foreach ($cases as [$pageCount, $published, $pdf, $pdfEnabled, $isAdmin, $expectCover]) {
            $book = (new Product)->forceFill([
                'id' => 1,
                'slug' => 'library-cover-test',
                'title' => 'Library Cover Test',
                'book_pages_count' => $pageCount,
                'book_content_published' => $published,
                'pdf_file' => $pdf,
                'pdf_reader_enabled' => $pdfEnabled,
                'book_content_cover' => 'products/book-content-covers/library-test.png',
            ]);
            $html = view('online-lezen', [
                'products' => collect([$book]),
                'categories' => collect(),
                'isAdmin' => $isAdmin,
            ])->render();

            $this->assertSame($expectCover, str_contains($html, 'class="shelf-book-custom-cover"'));
            $this->assertSame($expectCover, str_contains($html, 'shelf-book-cover--custom'));
            if ($pageCount === 0 && $pdfEnabled && $pdf) {
                $this->assertStringContainsString(route('onlineLezenRead', $book->slug), $html);
                $this->assertStringNotContainsString('shelf-book--unpublished', $html);
            }
        }
    }

    public function test_seeder_creates_a_missing_online_only_book_and_can_be_rerun(): void
    {
        $this->seed(CevsenPagesSeeder::class);

        $product = Product::where('slug', 'cevsen-ul-kebir')->sole();
        $this->assertSame('Cevşen-ül Kebir', $product->title);
        $this->assertFalse((bool) $product->is_published);
        $this->assertFalse($product->book_content_published);
        $this->assertSame(0, $product->stock);
        $this->assertSame(100, $product->bookPages()->count());
        $this->getJson('/api/v1/books/cevsen-ul-kebir/pages')->assertNotFound();

        $product->update([
            'title' => 'Existing title',
            'book_content_published' => true,
            'is_published' => true,
            'stock' => 7,
        ]);
        $this->seed(CevsenPagesSeeder::class);

        $this->assertSame(1, Product::where('slug', 'cevsen-ul-kebir')->count());
        $this->assertSame('Existing title', $product->fresh()->title);
        $this->assertTrue($product->fresh()->book_content_published);
        $this->assertTrue((bool) $product->fresh()->is_published);
        $this->assertSame(7, $product->fresh()->stock);
        $this->assertSame(100, $product->bookPages()->count());
        $this->getJson('/api/v1/books/cevsen-ul-kebir/pages')
            ->assertOk()
            ->assertJsonPath('book.title', 'Existing title');
    }

    public function test_cevsen_reader_omits_series_and_author_but_keeps_the_main_title(): void
    {
        foreach (['cevsen-ul-kebir', 'regular-book'] as $slug) {
            $product = (new Product)->forceFill([
                'id' => 1,
                'slug' => $slug,
                'title' => 'Reader title',
            ]);
            $pages = collect([(new BookPage)->forceFill([
                'page_number' => 1,
                'book_title' => 'Reader title',
                'content' => '<div class="page" id="1"><p>Content</p></div>',
            ])]);

            $html = view('online-lezen-html-reader', [
                'product' => $product,
                'pages' => $pages,
                'allPageMeta' => $pages,
                'tocEntries' => [],
            ])->render();

            $this->assertStringContainsString('<h1 class="book-title">Reader title</h1>', $html);
            $this->assertSame($slug !== 'cevsen-ul-kebir', str_contains($html, 'Uit de Reeks van de Risale-i Nur'));
            $this->assertSame($slug !== 'cevsen-ul-kebir', str_contains($html, 'Bedi&uuml;zzaman Said Nurs&icirc;'));
        }
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

    public function test_search_rate_limit_does_not_block_book_downloads(): void
    {
        $book = Product::query()->create(['slug' => 'limiet', 'title' => 'Limiet', 'book_content_published' => true]);
        BookPage::create(['product_id' => $book->id, 'page_number' => 1, 'content' => '<p>Over het geloof.</p>']);

        for ($i = 0; $i < 60; $i++) {
            $this->getJson('/api/v1/search?q=geloof')->assertOk();
        }
        $this->getJson('/api/v1/books/limiet/search?q=geloof')->assertTooManyRequests();

        $this->getJson('/api/v1/books')->assertOk();
        $this->getJson('/api/v1/books/limiet/navigation')->assertOk();
        $this->getJson('/api/v1/books/limiet/pages?after=0&limit=20')->assertOk();
    }

    public function test_catalog_lists_newly_published_books_with_reader_metadata(): void
    {
        $book = Product::query()->create([
            'slug' => 'new-native-reader-book',
            'title' => 'New Native Reader Book',
            'short_description' => 'A short book description.',
            'online_lezen_image' => 'images/native-cover.png',
            'book_content_cover' => 'products/book-content-covers/custom-cover.webp',
            'image_1' => 'images/default-cover.png',
            'book_content_language' => 'nl',
            'book_content_type' => 'leesboek',
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
            'online_lezen_image' => 'images/non-library-cover.png',
            'image_1' => 'images/default-cover.png',
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
            'book_content_cover' => 'products/book-content-covers/unpublished-cover.webp',
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
            ->assertJsonPath('books.1.cover_image', secure_url('storage/products/book-content-covers/custom-cover.webp'))
            ->assertJsonPath('books.1.language', 'nl')
            ->assertJsonPath('books.1.book_type', 'leesboek')
            ->assertJsonPath('books.0.cover_image', null)
            ->assertJsonMissing(['cover_image' => secure_url('storage/products/book-content-covers/unpublished-cover.webp')])
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

    public function test_book_content_metadata_can_be_saved_and_is_returned_in_the_catalog(): void
    {
        $book = Product::create([
            'slug' => 'metadata-book',
            'title' => 'Metadata Book',
            'book_content_published' => true,
        ]);
        $page = BookPage::create([
            'product_id' => $book->id,
            'page_number' => 14,
            'content' => '<div class="page empty-page" id="14"></div>',
        ]);
        $previousVersion = app(BookContentVersion::class)->snapshot($book)['content_version'];

        foreach (array_keys(Product::BOOK_CONTENT_LANGUAGES) as $language) {
            foreach (array_keys(Product::BOOK_CONTENT_TYPES) as $type) {
                app(BookContentController::class)->update(Request::create('/', 'PUT', [
                    'book_content_language' => $language,
                    'book_content_type' => $type,
                ]), $book->id);

                $book->refresh();
                $this->assertSame($language, $book->book_content_language);
                $this->assertSame($type, $book->book_content_type);
                $this->assertSame($page->content, $page->fresh()->content);
                $version = app(BookContentVersion::class)->snapshot($book)['content_version'];
                $this->assertNotSame($previousVersion, $version);
                $previousVersion = $version;
                $this->getJson('/api/v1/books')
                    ->assertOk()
                    ->assertJsonPath('books.0.language', $language)
                    ->assertJsonPath('books.0.book_type', $type)
                    ->assertJsonPath('books.0.content_version', $version);
            }
        }

        app(BookContentController::class)->update(Request::create('/', 'PUT'), $book->id);
        $this->assertSame('tr', $book->fresh()->book_content_language);
        $this->assertSame('quran', $book->fresh()->book_content_type);

        app(BookContentController::class)->update(Request::create('/', 'PUT', [
            'book_content_language' => null,
            'book_content_type' => null,
        ]), $book->id);
        $this->assertNull($book->fresh()->book_content_language);
        $this->assertNull($book->fresh()->book_content_type);
    }

    public function test_book_content_metadata_rejects_unsupported_choices(): void
    {
        $book = Product::create([
            'slug' => 'invalid-metadata-book',
            'title' => 'Invalid Metadata Book',
            'book_content_language' => 'nl',
            'book_content_type' => 'leesboek',
        ]);

        foreach ([
            'book_content_language' => 'fr',
            'book_content_type' => 'unknown',
        ] as $field => $value) {
            try {
                app(BookContentController::class)->update(Request::create('/', 'PUT', [
                    $field => $value,
                ]), $book->id);
                $this->fail('Unsupported book metadata was accepted.');
            } catch (ValidationException $exception) {
                $this->assertArrayHasKey($field, $exception->errors());
            }
        }

        $this->assertSame('nl', $book->fresh()->book_content_language);
        $this->assertSame('leesboek', $book->fresh()->book_content_type);
    }

    public function test_book_content_cover_can_be_uploaded_and_removed(): void
    {
        Storage::fake('public');

        $book = Product::query()->create([
            'slug' => 'book-with-custom-cover',
            'title' => 'Book With Custom Cover',
            'book_content_published' => false,
        ]);

        $controller = app(BookContentController::class);
        $controller->update(
            Request::create('/dashboard/book-content/'.$book->id, 'PUT', [], [], [
                'book_content_cover' => UploadedFile::fake()->image('cover.png'),
            ]),
            $book->id
        );

        $book->refresh();
        $this->assertNotNull($book->book_content_cover);
        Storage::disk('public')->assertExists($book->book_content_cover);
        $uploadedCover = $book->book_content_cover;

        $controller->update(
            Request::create('/dashboard/book-content/'.$book->id, 'PUT', [
                'delete_book_content_cover' => '1',
            ]),
            $book->id
        );

        $book->refresh();
        $this->assertNull($book->book_content_cover);
        Storage::disk('public')->assertMissing($uploadedCover);
    }

    public function test_book_content_save_uses_page_number_from_html_instead_of_stale_form_value(): void
    {
        $book = Product::query()->create([
            'slug' => 'book-with-stale-page-number',
            'title' => 'Book With Stale Page Number',
        ]);
        $emptyPage = BookPage::create([
            'product_id' => $book->id,
            'page_number' => 9,
            'content' => '<div class="page empty-page" id="9"></div>',
        ]);
        $otherPage = BookPage::create([
            'product_id' => $book->id,
            'page_number' => 14,
            'content' => '<div class="page" id="14"><p>Other page</p></div>',
        ]);

        app(BookContentController::class)->update(
            Request::create('/dashboard/book-content/'.$book->id, 'PUT', [
                'pages' => [
                    $emptyPage->id => [
                        'id' => $emptyPage->id,
                        'page_number' => 10,
                        'content' => '<div class="page empty-page id="14"></div>',
                    ],
                    $otherPage->id => [
                        'id' => $otherPage->id,
                        'page_number' => 9,
                        'content' => '<div class="page" id="9"><p>Other page</p></div>',
                    ],
                ],
            ]),
            $book->id
        );

        $this->assertSame(14, $emptyPage->fresh()->page_number);
        $this->assertSame('<div class="page empty-page id="14"></div>', $emptyPage->fresh()->content);
        $this->assertDatabaseHas('book_pages', [
            'product_id' => $book->id,
            'page_number' => 9,
        ]);
    }

    public function test_book_versions_are_stable_and_shared_by_catalog_navigation_and_pages(): void
    {
        $book = Product::query()->create(['slug' => 'versioned-book', 'title' => 'Versioned Book', 'book_content_published' => true]);
        BookPage::create(['product_id' => $book->id, 'page_number' => 5, 'content' => '<p>Tekst</p>']);
        $version = $this->getJson('/api/v1/books')->assertOk()->json('books.0.content_version');
        $this->assertMatchesRegularExpression('/^[a-f0-9]{64}$/', $version);
        $this->getJson('/api/v1/books/versioned-book/navigation')->assertOk()->assertJsonPath('book.content_version', $version);
        $this->getJson('/api/v1/books/versioned-book/pages')->assertOk()->assertJsonPath('book.content_version', $version);
        $book->update(['updated_at' => now()->addDay()]);
        $this->getJson('/api/v1/books')->assertOk()->assertJsonPath('books.0.content_version', $version);
    }

    public function test_text_footnotes_page_numbers_and_contents_change_the_book_version_without_timestamp_updates(): void
    {
        $book = Product::query()->create(['slug' => 'versioned-book', 'title' => 'Versioned Book', 'book_content_published' => true]);
        $page = BookPage::create(['product_id' => $book->id, 'page_number' => 5, 'content' => '<p>Tekst</p>']);
        $versions = app(BookContentVersion::class);
        $version = $versions->snapshot($book)['content_version'];
        foreach ([
            '<p>Gewijzigde tekst</p>',
            '<p>Gewijzigde tekst</p><div class="page-footnote"><p class="footnote-p"><sup>1</sup>Nieuwe noot</p></div>',
        ] as $html) {
            BookPage::query()->whereKey($page->id)->update(['content' => $html]);
            $next = $versions->snapshot($book)['content_version'];
            $this->assertNotSame($version, $next);
            $version = $next;
        }
        BookPage::query()->whereKey($page->id)->update(['page_number' => 7]);
        $next = $versions->snapshot($book)['content_version'];
        $this->assertNotSame($version, $next);
        config(['book_toc.versioned-book' => [['level' => 'main', 'title' => 'Nieuw', 'subtitle' => null, 'page' => 7]]]);
        $version = $versions->snapshot($book)['content_version'];
        $this->assertNotSame($next, $version);
        $added = BookPage::create(['product_id' => $book->id, 'page_number' => 8, 'content' => '<p>Toegevoegd</p>']);
        $this->assertNotSame($version, $versions->snapshot($book)['content_version']);
        $added->delete();
        $this->assertSame($version, $versions->snapshot($book)['content_version']);
        $book->title = 'Nieuwe titel';
        $this->assertNotSame($version, $versions->snapshot($book)['content_version']);
    }

    public function test_same_path_images_in_body_footnotes_and_cover_change_the_version(): void
    {
        $source = 'images/book-version-'.bin2hex(random_bytes(8)).'.svg';
        $path = public_path($source);
        file_put_contents($path, '<svg>first</svg>');
        try {
            $book = Product::query()->create(['slug' => 'images-book', 'title' => 'Images Book', 'book_content_published' => true]);
            $page = BookPage::create(['product_id' => $book->id, 'page_number' => 5, 'content' => '<p>Tekst</p>']);
            foreach (['body', 'footnote', 'cover'] as $location) {
                $book->image_1 = $location === 'cover' ? $source : null;
                $html = match ($location) {
                    'body' => '<p><img src="/'.$source.'"></p>',
                    'footnote' => '<div class="page-footnote"><p class="footnote-p"><sup>1</sup><img src="/'.$source.'"></p></div>',
                    default => '<p>Tekst</p>',
                };
                $page->update(['content' => $html]);
                file_put_contents($path, '<svg>first</svg>');
                $version = app(BookContentVersion::class)->snapshot($book)['content_version'];
                // Same byte count and timestamp: hashing must detect an in-place replacement.
                $time = filemtime($path);
                file_put_contents($path, '<svg>other</svg>');
                touch($path, $time);
                $this->assertNotSame($version, app(BookContentVersion::class)->snapshot($book)['content_version']);
            }
        } finally {
            unlink($path);
        }
    }

    public function test_page_downloads_reject_a_stale_version_and_validate_the_version_parameter(): void
    {
        $book = Product::query()->create(['slug' => 'versioned-book', 'title' => 'Versioned Book', 'book_content_published' => true]);
        $page = BookPage::create(['product_id' => $book->id, 'page_number' => 5, 'content' => '<p>Tekst</p>']);
        $version = $this->getJson('/api/v1/books/versioned-book/navigation')->json('book.content_version');
        $this->getJson('/api/v1/books/versioned-book/pages?version='.$version)->assertOk();
        $page->update(['content' => '<p>Nieuwe tekst</p>']);
        $this->getJson('/api/v1/books/versioned-book/pages?version='.$version)
            ->assertStatus(409)->assertJsonPath('message', 'Het boek is gewijzigd. Start de download opnieuw.');
        $this->getJson('/api/v1/books/versioned-book/pages?version=invalid')
            ->assertUnprocessable()->assertJsonValidationErrors('version');
        $this->getJson('/api/v1/books/versioned-book/pages')->assertOk();
    }
}
