<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OnlineLezenSeoController extends Controller
{
    /**
     * List all products available in the online library.
     */
    public function index()
    {
        $products = Product::query()
            ->where(function ($q) {
                $q->where('pdf_reader_enabled', true)
                  ->orWhere('book_content_published', true);
            })
            ->withCount('bookPages')
            ->orderBy('title')
            ->paginate(20);

        return view('admin.online-lezen-seo.index', compact('products'));
    }

    /**
     * Show the SEO edit form for a single product (online-lezen context).
     */
    public function edit(int $id)
    {
        $product = Product::findOrFail($id);

        // Effective SEO title and description for online-lezen context
        $effectiveTitle       = $product->seo_title ?: $product->title;
        $effectiveDescription = $product->seo_description ?: $product->short_description;

        $previewTitle       = $effectiveTitle . ' | Online Lezen | Lucide Inkt';
        $previewUrl         = route('onlineLezenRead', $product->slug);

        return view('admin.online-lezen-seo.edit', compact(
            'product',
            'effectiveTitle',
            'effectiveDescription',
            'previewTitle',
            'previewUrl'
        ));
    }

    /**
     * Save the SEO fields for a product.
     */
    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'seo_title'       => 'nullable|string|max:70',
            'seo_description' => 'nullable|string|max:320',
        ]);

        $product->update($validated);

        return redirect()->route('admin.online-lezen-seo.index')
            ->with('success', 'SEO voor "' . $product->title . '" opgeslagen.');
    }
}

