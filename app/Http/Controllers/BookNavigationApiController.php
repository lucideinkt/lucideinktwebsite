<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class BookNavigationApiController extends Controller
{
    public function index(string $slug): JsonResponse
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->where('book_content_published', true)
            ->whereHas('bookPages')
            ->firstOrFail();

        $pageNumbers = $product->bookPages()
            ->orderBy('page_number')
            ->pluck('page_number')
            ->map(fn ($number): int => (int) $number)
            ->values();

        return response()->json([
            'schema_version' => 1,
            'book' => [
                'slug' => $product->slug,
                'title' => $product->title,
            ],
            'page_numbers' => $pageNumbers,
            'toc' => config('book_toc.'.$slug, []),
        ]);
    }
}
