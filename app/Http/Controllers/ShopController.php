<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCopy as ProductCopy;
use App\Services\SEOService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        // Group products by base_slug, only show parent/base product for each group
        $products = Product::with('category')
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->get();
//            ->unique('base_slug');

        return view('shop.index', [
            'products' => $products,
            'SEOData' => SEOService::getPageSEO('shop'),
        ]);
    }

    public function show(string $slug)
    {
        // Find the parent/base product by base_slug
        $product = Product::where('slug', $slug)
            ->firstOrFail();

        // Get all exemplaren (variants) for this base product
//        $exemplaren = Product::where('base_slug', $slug)
//            ->where('is_published', 1)
//            ->get();

        // Get all unique product_copy_id values
//        $productCopyIds = $exemplaren->pluck('product_copy_id')->unique()->filter();

        // Fetch all published, not deleted ProductCopy records for these IDs
//        $productCopies = [];
//        if ($productCopyIds->isNotEmpty()) {
//            $productCopies = ProductCopy::whereIn('id', $productCopyIds)
//                ->where('is_published', 1)
//                ->whereNull('deleted_at')
//                ->get();
//        }

        // Use the model's getDynamicSEOData() which includes full Schema.org structured data
        // (Book/Product + Offer + BreadcrumbList JSON-LD). Patch the OG image to prefer
        // JPEG (no transparent backgrounds on social platforms).
        $seoData = $product->getDynamicSEOData();
        $seoData->image = SEOService::resolveOgImage($product->image_1);

        return view('shop.show', [
            'product' => $product,
            'SEOData' => $seoData,
//            'productCopies' => $productCopies,
//            'exemplaren' => $exemplaren,
        ]);
    }

}
