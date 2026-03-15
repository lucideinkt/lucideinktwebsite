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
     * Schone HTML lezer pagina — laadt alleen de eerste batch server-side
     */
    public function readHtml($slug)
    {
        $product = Product::where('slug', '=', $slug)->firstOrFail();

        // First batch rendered server-side (fast initial load)
        $initialPages = $product->bookPages()->orderBy('page_number')->limit(5)->get();

        abort_if($initialPages->isEmpty(), 404);

        // All page numbers + book_title for dropdown + progress bar (lightweight)
        $allPageMeta = $product->bookPages()
            ->orderBy('page_number')
            ->get(['page_number', 'book_title']);

        return view('online-lezen-html-reader', [
            'product'      => $product,
            'pages'        => $initialPages,
            'allPageMeta'  => $allPageMeta,
            'SEOData'      => SEOService::getProductSEO($product, 'online-lezen-html'),
        ]);
    }

    /**
     * JSON API — geeft pagina's terug na een bepaald paginanummer
     */
    public function pagesApi($slug, Request $request)
    {
        $product = Product::where('slug', '=', $slug)->firstOrFail();

        $after = (int) $request->query('after', 0);
        $limit = min((int) $request->query('limit', 10), 20); // max 20 per request

        $pages = $product->bookPages()
            ->orderBy('page_number')
            ->where('page_number', '>', $after)
            ->limit($limit)
            ->get(['page_number', 'content']);

        return response()->json([
            'pages'    => $pages,
            'has_more' => $product->bookPages()->where('page_number', '>', $after)->count() > $limit,
        ]);
    }
}




