<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SEOService;
use Illuminate\Http\Request;

class AudiobooksController extends Controller
{
    /**
     * Display the audiobook library
     */
    public function index()
    {
        // Get only published products that have an audio file
        $products = Product::with(['category', 'productCopy'])
            ->whereNotNull('audio_file')
            ->where('audio_file', '!=', '')
            ->orderBy('title', 'asc')
            ->get();

        return view('audiobooks', [
            'products' => $products,
            'SEOData' => SEOService::getPageSEO('audiobooks'),
        ]);
    }

    /**
     * Display the audio player for a specific audiobook
     */
    public function listen(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_published', 1)
            ->firstOrFail();

        return view('audiobooks-player', [
            'product' => $product,
            'SEOData' => SEOService::getProductSEO($product, 'audiobooks'),
        ]);
    }
}


