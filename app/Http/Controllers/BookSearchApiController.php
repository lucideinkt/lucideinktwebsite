<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookSearchApiController extends Controller
{
    public function index(Request $request, string $slug, OnlineLezenController $reader): JsonResponse
    {
        $request->validate(['q' => ['required', 'string', 'min:2', 'max:200']]);
        Product::query()->where('slug', $slug)->where('book_content_published', true)
            ->whereHas('bookPages')->firstOrFail();

        return $reader->searchApi($slug, $request);
    }
}
