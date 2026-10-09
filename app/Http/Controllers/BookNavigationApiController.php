<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\BookContentVersion;
use Illuminate\Http\JsonResponse;

class BookNavigationApiController extends Controller
{
    public function index(string $slug, BookContentVersion $versions): JsonResponse
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->where('book_content_published', true)
            ->whereHas('bookPages')
            ->firstOrFail();

        $snapshot = $versions->snapshot($product);
        $pageNumbers = $snapshot['pages']->pluck('page_number')
            ->map(fn ($number): int => (int) $number)
            ->values();

        return response()->json([
            'schema_version' => 1,
            'book' => [
                'slug' => $product->slug,
                'title' => $product->title,
                'content_version' => $snapshot['content_version'],
            ],
            'page_numbers' => $pageNumbers,
            'toc' => $snapshot['toc'],
        ]);
    }
}
