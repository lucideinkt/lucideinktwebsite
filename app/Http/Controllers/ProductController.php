<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCopy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ImageCompressionService;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected ImageCompressionService $imageCompressionService;

    public function __construct(ImageCompressionService $imageCompressionService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->imageCompressionService = $imageCompressionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);

        $products = Product::with(['category', 'productCopy'])
            ->orderBy('title', 'desc')
            ->paginate(10);

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        $products = Product::orderBy('title', 'asc')->get();
        $categories = ProductCategory::orderBy('name', 'asc')->get();
        $productCopies = ProductCopy::orderBy('name', 'asc')->get();

        return view('products.form', [
            'product' => null,
            'products' => $products,
            'categories' => $categories,
            'productCopies' => $productCopies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $copy = !empty($validated['product_copy_id'])
            ? ProductCopy::find($validated['product_copy_id'])
            : null;

        $title = trim($validated['title']);

        // base_title altijd zonder exemplaar
        if ($copy && $copy->name) {
            $baseTitle = preg_replace('/\s*-\s*'.preg_quote($copy->name, '/').'$/iu', '', $title);
        } else {
            $baseTitle = $title;
        }
        $baseSlug = Str::slug($baseTitle);

        // title = base_title + exemplaar (indien aanwezig)
        if ($copy && $copy->name) {
            $title = $baseTitle.' - '.$copy->name;
        }

        // Slug genereren
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->whereNull('deleted_at')->exists()) {
            $slug = $originalSlug.'-'.$counter++;
        }

        // Afbeeldingen verwerken
        for ($i = 1; $i <= 4; $i++) {
            $imageField = 'image_'.$i;
            if ($request->hasFile($imageField)) {
                $validated[$imageField] = $this->imageCompressionService->compressAndStore($request->file($imageField));
            }
        }

        // PDF bestand verwerken
        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        }

        // Audio bestand verwerken
        if ($request->hasFile('audio_file')) {
            $validated['audio_file'] = $request->file('audio_file')->store('audio', 'public');
        }

        // Online Lezen afbeelding verwerken
        if ($request->hasFile('online_lezen_image')) {
            $validated['online_lezen_image'] = $this->imageCompressionService->compressAndStore($request->file('online_lezen_image'));
        }

        // Convert comma-separated tags string to array
        if (!empty($validated['seo_tags'])) {
            $tags = array_map('trim', explode(',', $validated['seo_tags']));
            $tags = array_filter($tags); // Remove empty values
            $validated['seo_tags'] = !empty($tags) ? array_values($tags) : null;
        } else {
            $validated['seo_tags'] = null;
        }

        $user = auth()->user();
        $product = Product::create([
            'title' => $title,
            'base_title' => $baseTitle,
            'slug' => $slug,
            'base_slug' => $baseSlug,
            'category_id' => $validated['category_id'],
            'is_published' => $validated['is_published'],
            'short_description' => $validated['short_description'] ?? null,
            'long_description' => $validated['long_description'] ?? null,
            'price' => $validated['price'] ?? null,
            'stock' => $validated['stock'] ?? 0,
            'product_copy_id' => $validated['product_copy_id'] ?? null,
            'weight' => $validated['weight'] ?? null,
            'height' => $validated['height'] ?? null,
            'width' => $validated['width'] ?? null,
            'depth' => $validated['depth'] ?? null,
            'pages' => $validated['pages'] ?? null,
            'binding_type' => $validated['binding_type'] ?? null,
            'ean_code' => $validated['ean_code'] ?? null,
            'image_1' => $validated['image_1'] ?? null,
            'image_2' => $validated['image_2'] ?? null,
            'image_3' => $validated['image_3'] ?? null,
            'image_4' => $validated['image_4'] ?? null,
            'pdf_file' => $validated['pdf_file'] ?? null,
            'audio_file' => $validated['audio_file'] ?? null,
            'online_lezen_image' => $validated['online_lezen_image'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'seo_author' => $validated['seo_author'] ?? null,
            'seo_robots' => $validated['seo_robots'] ?? null,
            'seo_canonical_url' => $validated['seo_canonical_url'] ?? null,
            'created_by' => $user->first_name . ' ' . $user->last_name,
        ]);

        return redirect()->route('productIndex')->with('success',
            'Product met ID: '.$product->id.' succesvol aangemaakt.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $products = Product::orderBy('title', 'asc')->get();
        $categories = ProductCategory::orderBy('name', 'asc')->get();
        $productCopies = ProductCopy::orderBy('name', 'asc')->get();

        return view('products.form', [
            'product' => $product,
            'products' => $products,
            'categories' => $categories,
            'productCopies' => $productCopies
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validated();

        $copy = !empty($validated['product_copy_id'])
            ? ProductCopy::find($validated['product_copy_id'])
            : null;

        $title = trim($validated['title']);

        // base_title altijd zonder exemplaar
        if ($copy && $copy->name) {
            $baseTitle = preg_replace('/\s*-\s*'.preg_quote($copy->name, '/').'$/iu', '', $title);
        } else {
            $baseTitle = $title;
        }
        $baseSlug = Str::slug($baseTitle);

        // title = base_title + exemplaar (indien aanwezig)
        if ($copy && $copy->name) {
            $title = $baseTitle.' - '.$copy->name;
        }

        // Slug genereren
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->whereNull('deleted_at')->where('id', '!=', $product->id)->exists()) {
            $slug = $originalSlug.'-'.$counter++;
        }

        // Afbeeldingen verwerken
        for ($i = 1; $i <= 4; $i++) {
            $imageField = 'image_'.$i;
            $deleteField = 'delete_image_'.$i;

            if ($request->has($deleteField) && $product->$imageField) {
                if (Storage::disk('public')->exists($product->$imageField)) {
                    Storage::disk('public')->delete($product->$imageField);
                }
                $validated[$imageField] = null;
            } elseif ($request->hasFile($imageField)) {
                if (!empty($product->$imageField) && Storage::disk('public')->exists($product->$imageField)) {
                    Storage::disk('public')->delete($product->$imageField);
                }
                $validated[$imageField] = $this->imageCompressionService->compressAndStore($request->file($imageField));
            } else {
                $validated[$imageField] = $product->$imageField;
            }
        }

        // PDF bestand verwerken
        if ($request->has('delete_pdf_file') && $product->pdf_file) {
            // Verwijder bestaande PDF
            if (Storage::disk('public')->exists($product->pdf_file)) {
                Storage::disk('public')->delete($product->pdf_file);
            }
            $validated['pdf_file'] = null;
        } elseif ($request->hasFile('pdf_file')) {
            // Verwijder oude PDF als die bestaat
            if (!empty($product->pdf_file) && Storage::disk('public')->exists($product->pdf_file)) {
                Storage::disk('public')->delete($product->pdf_file);
            }
            // Upload nieuwe PDF
            $validated['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        } else {
            // Behoud bestaande PDF
            $validated['pdf_file'] = $product->pdf_file;
        }

        // Audio bestand verwerken
        if ($request->has('delete_audio_file') && $product->audio_file) {
            // Verwijder bestaande audio
            if (Storage::disk('public')->exists($product->audio_file)) {
                Storage::disk('public')->delete($product->audio_file);
            }
            $validated['audio_file'] = null;
        } elseif ($request->hasFile('audio_file')) {
            // Verwijder oude audio als die bestaat
            if (!empty($product->audio_file) && Storage::disk('public')->exists($product->audio_file)) {
                Storage::disk('public')->delete($product->audio_file);
            }
            // Upload nieuwe audio
            $validated['audio_file'] = $request->file('audio_file')->store('audio', 'public');
        } else {
            // Behoud bestaande audio
            $validated['audio_file'] = $product->audio_file;
        }

        // Online Lezen afbeelding verwerken
        if ($request->has('delete_online_lezen_image') && $product->online_lezen_image) {
            // Verwijder bestaande afbeelding
            if (Storage::disk('public')->exists($product->online_lezen_image)) {
                Storage::disk('public')->delete($product->online_lezen_image);
            }
            $validated['online_lezen_image'] = null;
        } elseif ($request->hasFile('online_lezen_image')) {
            // Verwijder oude afbeelding als die bestaat
            if (!empty($product->online_lezen_image) && Storage::disk('public')->exists($product->online_lezen_image)) {
                Storage::disk('public')->delete($product->online_lezen_image);
            }
            // Upload nieuwe afbeelding (gebruik de bestaande compressie functie)
            $validated['online_lezen_image'] = $this->imageCompressionService->compressAndStore($request->file('online_lezen_image'));
        } else {
            // Behoud bestaande afbeelding
            $validated['online_lezen_image'] = $product->online_lezen_image;
        }

        // Convert comma-separated tags string to array
        if (!empty($validated['seo_tags'])) {
            $tags = array_map('trim', explode(',', $validated['seo_tags']));
            $tags = array_filter($tags); // Remove empty values
            $validated['seo_tags'] = !empty($tags) ? array_values($tags) : null;
        } else {
            $validated['seo_tags'] = null;
        }

        $product->update([
            'title' => $title,
            'base_title' => $baseTitle,
            'slug' => $slug,
            'base_slug' => $baseSlug,
            'category_id' => $validated['category_id'],
            'is_published' => $validated['is_published'],
            'short_description' => $validated['short_description'] ?? null,
            'long_description' => $validated['long_description'] ?? null,
            'price' => $validated['price'] ?? null,
            'stock' => $validated['stock'] ?? null,
            'product_copy_id' => $validated['product_copy_id'] ?? null,
            'weight' => $validated['weight'] ?? null,
            'height' => $validated['height'] ?? null,
            'width' => $validated['width'] ?? null,
            'depth' => $validated['depth'] ?? null,
            'pages' => $validated['pages'] ?? null,
            'binding_type' => $validated['binding_type'] ?? null,
            'ean_code' => $validated['ean_code'] ?? null,
            'image_1' => $validated['image_1'] ?? null,
            'image_2' => $validated['image_2'] ?? null,
            'image_3' => $validated['image_3'] ?? null,
            'image_4' => $validated['image_4'] ?? null,
            'pdf_file' => $validated['pdf_file'] ?? null,
            'audio_file' => $validated['audio_file'] ?? null,
            'online_lezen_image' => $validated['online_lezen_image'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'seo_author' => $validated['seo_author'] ?? null,
            'seo_robots' => $validated['seo_robots'] ?? null,
            'seo_canonical_url' => $validated['seo_canonical_url'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Het product is succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);

        // Verwijder afbeeldingen uit storage
        for ($i = 1; $i <= 4; $i++) {
            $imageField = 'image_'.$i;
            if (!empty($product->$imageField) && Storage::disk('public')->exists($product->$imageField)) {
                Storage::disk('public')->delete($product->$imageField);
            }
        }

        // Verwijder PDF bestand
        if (!empty($product->pdf_file) && Storage::disk('public')->exists($product->pdf_file)) {
            Storage::disk('public')->delete($product->pdf_file);
        }

        // Verwijder audio bestand
        if (!empty($product->audio_file) && Storage::disk('public')->exists($product->audio_file)) {
            Storage::disk('public')->delete($product->audio_file);
        }

        // Verwijder online lezen afbeelding
        if (!empty($product->online_lezen_image) && Storage::disk('public')->exists($product->online_lezen_image)) {
            Storage::disk('public')->delete($product->online_lezen_image);
        }

        $product->update([
            'updated_by' => auth()->id(),
            'deleted_by' => auth()->id(),
            'image_1' => '',
            'image_2' => '',
            'image_3' => '',
            'image_4' => '',
            'pdf_file' => '',
            'audio_file' => '',
            'online_lezen_image' => '',
        ]);

        $product->delete();

        return redirect()->route('productIndex')->with('success', 'Het product is succesvol verwijderd.');
    }

    public function get()
    {
        return redirect()->route('dashboard');
    }
}
