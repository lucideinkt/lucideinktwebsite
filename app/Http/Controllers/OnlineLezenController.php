<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SEOService;
use Illuminate\Http\Request;

class OnlineLezenController extends Controller
{
    /**
     * Display the online reading library
     */
    public function index()
    {
        // Get only published products that have a PDF file
        $products = Product::with(['category', 'productCopy'])
            ->where('is_published', 1)
            ->whereNotNull('pdf_file')
            ->where('pdf_file', '!=', '')
            ->orderBy('title', 'asc')
            ->get();

        return view('online-lezen', [
            'products' => $products,
            'SEOData' => SEOService::getPageSEO('online-lezen'),
        ]);
    }

    /**
     * Display the PDF reader for a specific book
     */
    public function read(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_published', 1)
            ->firstOrFail();

        // Check if fullscreen mode is requested
        $isFullscreen = $request->query('fullscreen') === '1';

        // Use fullscreen layout if parameter is present
        $view = $isFullscreen ? 'online-lezen-reader-fullscreen' : 'online-lezen-reader';

        return view($view, [
            'product' => $product,
            'SEOData' => SEOService::getProductSEO($product, 'online-lezen'),
        ]);
    }
}
