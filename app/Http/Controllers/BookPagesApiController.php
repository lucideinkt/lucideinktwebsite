<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\BookContentVersion;
use App\Services\BookPageJsonSerializer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookPagesApiController extends Controller
{
    public function index(Request $request, string $slug, BookPageJsonSerializer $serializer, BookContentVersion $versions): JsonResponse
    {
        $validated = $request->validate([
            'after' => ['sometimes', 'integer', 'min:0'],
            'limit' => ['sometimes', 'integer', 'min:1', 'max:20'],
            'version' => ['sometimes', 'string', 'regex:/^[a-f0-9]{64}$/'],
        ]);

        $product = Product::query()
            ->where('slug', $slug)
            ->where('book_content_published', true)
            ->firstOrFail();

        $after = (int) ($validated['after'] ?? 0);
        $limit = (int) ($validated['limit'] ?? 10);
        $snapshot = $versions->snapshot($product);
        if (isset($validated['version']) && $validated['version'] !== $snapshot['content_version']) {
            return response()->json(['message' => 'Het boek is gewijzigd. Start de download opnieuw.'], 409);
        }
        $pages = $snapshot['pages']->filter(fn ($page) => $page->page_number > $after)->take($limit + 1);
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
                'content_version' => $snapshot['content_version'],
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
