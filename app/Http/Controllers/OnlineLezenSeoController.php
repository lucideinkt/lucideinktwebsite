<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $effectiveTitle       = $product->seo_title_online ?: ($product->seo_title ?: $product->title);
        $effectiveDescription = $product->seo_description_online ?: ($product->seo_description ?: $product->short_description);
        $previewTitle         = $effectiveTitle . ' | Online Lezen | Lucide Inkt';
        $previewUrl           = route('onlineLezenRead', $product->slug);

        return view('admin.online-lezen-seo.edit', compact(
            'product', 'effectiveTitle', 'effectiveDescription', 'previewTitle', 'previewUrl'
        ));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'seo_title_online'          => 'nullable|string|max:70',
            'seo_description_online'    => 'nullable|string|max:320',
            'seo_author'                => 'nullable|string|max:100',
            'seo_robots_online'         => 'nullable|string|max:100',
            'seo_canonical_url_online'  => 'nullable|url|max:500',
            'online_lezen_image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'delete_online_lezen_image' => 'nullable|boolean',
        ]);

        // Handle image deletion / upload
        if ($request->boolean('delete_online_lezen_image')) {
            if ($product->online_lezen_image && Storage::disk('public')->exists($product->online_lezen_image)) {
                Storage::disk('public')->delete($product->online_lezen_image);
            }
            $validated['online_lezen_image'] = null;
        } elseif ($request->hasFile('online_lezen_image') && $request->file('online_lezen_image')->isValid()) {
            if ($product->online_lezen_image && Storage::disk('public')->exists($product->online_lezen_image)) {
                Storage::disk('public')->delete($product->online_lezen_image);
            }
            $validated['online_lezen_image'] = $request->file('online_lezen_image')
                ->store('products/online-lezen', 'public');
        } else {
            unset($validated['online_lezen_image']);
        }

        unset($validated['delete_online_lezen_image']);

        $product->update($validated);

        return redirect()->route('admin.online-lezen-seo.index')
            ->with('success', 'SEO voor "' . $product->title . '" opgeslagen.');
    }
}
