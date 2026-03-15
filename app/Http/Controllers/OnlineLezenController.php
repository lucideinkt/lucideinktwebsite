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
        $products = Product::with(['category', 'productCopy'])
            ->withCount('bookPages')
            ->where(function ($q) {
                $q->whereNotNull('pdf_file')->where('pdf_file', '!=', '')
                  ->orWhere(function ($q2) {
                      $q2->whereNotNull('book_content')->where('book_content', '!=', '');
                  })
                  ->orWhereHas('bookPages');
            })
            ->orderBy('title', 'asc')
            ->get();

        return view('online-lezen', [
            'products' => $products,
            'SEOData'  => SEOService::getPageSEO('online-lezen'),
        ]);
    }

    /**
     * Display the PDF reader for a specific book
     */
    public function read(Request $request, $slug)
    {
        $product = Product::where('slug', '=', $slug)
            ->firstOrFail();

        // Als product HTML pagina's heeft → stuur door naar schone HTML lezer
        if ($product->bookPages()->exists()) {
            return redirect()->route('onlineLezenReadHtml', $slug);
        }

        // Check if fullscreen mode is requested
        $isFullscreen = $request->query('fullscreen') === '1';

        // Use fullscreen layout if parameter is present
        $view = $isFullscreen ? 'online-lezen-reader-fullscreen' : 'online-lezen-reader';

        return view($view, [
            'product' => $product,
            'SEOData' => SEOService::getProductSEO($product, 'online-lezen'),
        ]);
    }

    /**
     * Schone HTML lezer pagina
     */
    public function readHtml($slug)
    {
        $product = Product::where('slug', '=', $slug)->firstOrFail();

        $pages = $product->bookPages()->orderBy('page_number')->get();

        abort_if($pages->isEmpty(), 404);

        return view('online-lezen-html-reader', [
            'product' => $product,
            'pages'   => $pages,
            'SEOData' => SEOService::getProductSEO($product, 'online-lezen-html'),
        ]);
    }
}




