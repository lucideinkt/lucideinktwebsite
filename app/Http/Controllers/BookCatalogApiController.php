<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\BookContentVersion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookCatalogApiController extends Controller
{
    public function index(Request $request, BookContentVersion $versions): JsonResponse
    {
        $validated = $request->validate([
            'page' => ['sometimes', 'integer', 'min:1'],
            'limit' => ['sometimes', 'integer', 'min:1', 'max:50'],
        ]);

        $page = (int) ($validated['page'] ?? 1);
        $limit = (int) ($validated['limit'] ?? 20);

        $books = Product::query()
            ->where('book_content_published', true)
            ->whereHas('bookPages')
            ->withCount('bookPages')
            ->orderBy('title')
            ->orderBy('id')
            ->paginate($limit, [
                'id',
                'title',
                'slug',
                'short_description',
                'image_1',
                'online_lezen_image',
                'book_content_cover',
                'book_content_published',
                'book_content_language',
                'book_content_type',
            ], 'page', $page);

        return response()->json([
            'schema_version' => 1,
            'books' => $books->getCollection()
                ->map(fn (Product $product): array => [
                    'slug' => $product->slug,
                    'title' => $product->title,
                    'description' => $product->short_description,
                    'language' => $product->book_content_language,
                    'book_type' => $product->book_content_type,
                    'cover_image' => $this->coverImageUrl($product),
                    'page_count' => $product->book_pages_count,
                    'pages_url' => route('api.v1.books.pages.index', ['slug' => $product->slug]),
                    'content_version' => $versions->snapshot($product)['content_version'],
                ])
                ->values(),
            'pagination' => [
                'page' => $books->currentPage(),
                'limit' => $books->perPage(),
                'total' => $books->total(),
                'last_page' => $books->lastPage(),
                'has_more' => $books->hasMorePages(),
            ],
        ]);
    }

    private function coverImageUrl(Product $product): ?string
    {
        $image = $product->book_content_published ? $product->book_content_cover : null;
        if (! $image) {
            return null;
        }

        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        if (str_starts_with($image, 'images/')) {
            return secure_url($image);
        }

        return secure_url('storage/'.$image);
    }
}
