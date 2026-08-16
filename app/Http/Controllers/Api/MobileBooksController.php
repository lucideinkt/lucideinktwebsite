<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class MobileBooksController extends Controller
{
    public function manifest()
    {
        $books = Product::query()
            ->withCount('bookPages')
            ->withMax('bookPages', 'updated_at')
            ->where('book_content_published', true)
            ->whereHas('bookPages')
            ->orderBy('title')
            ->get([
                'id',
                'title',
                'slug',
                'updated_at',
                'image_1',
                'online_lezen_image',
            ]);

        $payload = $books->map(function (Product $book) {
            return [
                'id' => $book->id,
                'slug' => $book->slug,
                'title' => $book->title,
                'page_count' => (int) $book->book_pages_count,
                'cover_url' => $this->resolveImageUrl($book->online_lezen_image ?: $book->image_1),
                'updated_at' => optional($book->updated_at)?->toISOString(),
                'pages_updated_at' => $book->book_pages_max_updated_at
                    ? (string) $book->book_pages_max_updated_at
                    : null,
                'version_hash' => $this->buildVersionHash($book),
            ];
        })->values();

        return response()->json([
            'generated_at' => now()->toISOString(),
            'books' => $payload,
        ]);
    }

    public function show(string $slug)
    {
        $book = Product::query()
            ->with(['bookPages' => fn ($query) => $query->orderBy('page_number')])
            ->withCount('bookPages')
            ->withMax('bookPages', 'updated_at')
            ->where('slug', $slug)
            ->where('book_content_published', true)
            ->whereHas('bookPages')
            ->firstOrFail([
                'id',
                'title',
                'slug',
                'updated_at',
                'image_1',
                'online_lezen_image',
            ]);

        return response()->json([
            'book' => [
                'id' => $book->id,
                'slug' => $book->slug,
                'title' => $book->title,
                'page_count' => (int) $book->book_pages_count,
                'cover_url' => $this->resolveImageUrl($book->online_lezen_image ?: $book->image_1),
                'updated_at' => optional($book->updated_at)?->toISOString(),
                'pages_updated_at' => $book->book_pages_max_updated_at
                    ? (string) $book->book_pages_max_updated_at
                    : null,
                'version_hash' => $this->buildVersionHash($book),
            ],
            'pages' => $book->bookPages->map(fn ($page) => [
                'page_number' => (int) $page->page_number,
                'content' => (string) $page->content,
                'updated_at' => optional($page->updated_at)?->toISOString(),
            ])->values(),
        ]);
    }

    private function buildVersionHash(Product $book): string
    {
        return sha1(implode('|', [
            $book->id,
            (string) optional($book->updated_at)?->timestamp,
            (string) optional($book->book_pages_max_updated_at)?->timestamp,
            (string) $book->book_pages_count,
        ]));
    }

    private function resolveImageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return asset('storage/'.$path);
    }
}
