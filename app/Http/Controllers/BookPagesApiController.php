<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\BookPageJsonSerializer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookPagesApiController extends Controller
{
    public function index(Request $request, string $slug, BookPageJsonSerializer $serializer): JsonResponse
    {
        $validated = $request->validate([
            'after' => ['sometimes', 'integer', 'min:0'],
            'limit' => ['sometimes', 'integer', 'min:1', 'max:20'],
        ]);

        $product = Product::query()
            ->where('slug', $slug)
            ->where('book_content_published', true)
            ->firstOrFail();

        $after = (int) ($validated['after'] ?? 0);
        $limit = (int) ($validated['limit'] ?? 10);
        $pages = $product->bookPages()
            ->where('page_number', '>', $after)
            ->orderBy('page_number')
            ->limit($limit + 1)
            ->get(['page_number', 'content']);
        $hasMore = $pages->count() > $limit;
        $pageData = $pages
            ->take($limit)
            ->map(fn ($page) => $serializer->serialize((int) $page->page_number, (string) $page->content))
            ->values();

        return response()->json([
            'schema_version' => 1,
            'book' => [
                'slug' => $product->slug,
                'title' => $product->title,
            ],
            'pages' => $pageData,
            'pagination' => [
                'after' => $after,
                'limit' => $limit,
                'next_after' => $pageData->isEmpty()
                    ? $after
                    : $pageData->last()['page_number'],
                'has_more' => $hasMore,
            ],
        ]);
    }
}
