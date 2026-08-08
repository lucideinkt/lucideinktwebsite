<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelenAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $artikelen = Artikel::ordered()->paginate(20)->withQueryString();

        return view('artikelen.index', compact('artikelen'));
    }

    public function create()
    {
        return view('artikelen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                => 'required|string|max:255',
            'intro'                => 'nullable|string',
            'featured_image'       => 'nullable|image|max:65536',
            'featured_image_alt'   => 'nullable|string|max:255',
            'og_image_upload'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:65536',
            'seo_description'      => 'nullable|string|max:165',
            'show_featured_image'  => 'sometimes|boolean',
            'is_published'         => 'sometimes|boolean',
            'sort_order'           => 'nullable|integer|min:0',
            'title_max_width'      => 'nullable|integer|min:200|max:1400',
        ]);

        $validated['is_published']        = $request->boolean('is_published');
        $validated['show_featured_image'] = $request->boolean('show_featured_image');
        $validated['sort_order']          = $validated['sort_order'] ?? 0;
        $validated['slug']                = Artikel::generateSlug($validated['title']);
        $validated['body']                = $request->input('body');

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('artikelen', 'public');
        }

        // OG/social image — stored in seo/og/artikelen/ (same location as page SEO images)
        if ($request->hasFile('og_image_upload') && $request->file('og_image_upload')->isValid()) {
            $validated['og_image'] = $request->file('og_image_upload')
                ->store('seo/og/artikelen', 'public');
        }
        unset($validated['og_image_upload']);

        Artikel::create($validated);

        return redirect()->route('admin.artikelen.index')
            ->with('success', 'Artikel succesvol aangemaakt!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate(['file' => 'required|image|max:8192']);

        $path = $request->file('file')->store('artikelen/editor', 'public');

        return response()->json(['location' => asset('storage/' . $path)]);
    }

    public function edit(string $id)
    {
        $artikel = Artikel::findOrFail($id);

        return view('artikelen.edit', compact('artikel'));
    }

    public function update(Request $request, string $id)
    {
        $artikel = Artikel::findOrFail($id);

        $validated = $request->validate([
            'title'                => 'required|string|max:255',
            'intro'                => 'nullable|string',
            'featured_image'       => 'nullable|image|max:65536',
            'featured_image_alt'   => 'nullable|string|max:255',
            'og_image_upload'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:65536',
            'seo_description'      => 'nullable|string|max:165',
            'show_featured_image'  => 'sometimes|boolean',
            'is_published'         => 'sometimes|boolean',
            'sort_order'           => 'nullable|integer|min:0',
            'title_max_width'      => 'nullable|integer|min:200|max:1400',
        ]);

        $validated['is_published']        = $request->boolean('is_published');
        $validated['show_featured_image'] = $request->boolean('show_featured_image');
        $validated['sort_order']          = $validated['sort_order'] ?? 0;
        $validated['body']                = $request->input('body');

        if ($request->title !== $artikel->title) {
            $validated['slug'] = Artikel::generateSlug($validated['title'], $artikel->id);
        }

        if ($request->hasFile('featured_image')) {
            if ($artikel->featured_image) {
                Storage::disk('public')->delete($artikel->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('artikelen', 'public');
        }

        if ($request->boolean('remove_featured_image') && $artikel->featured_image) {
            Storage::disk('public')->delete($artikel->featured_image);
            $validated['featured_image']     = null;
            $validated['featured_image_alt'] = null;
        }

        // OG/social image — stored in seo/og/artikelen/ (same path as page SEO images, avoids permission issues)
        if ($request->hasFile('og_image_upload') && $request->file('og_image_upload')->isValid()) {
            if ($artikel->og_image) {
                Storage::disk('public')->delete($artikel->og_image);
            }
            $validated['og_image'] = $request->file('og_image_upload')
                ->store('seo/og/artikelen', 'public');
        }

        if ($request->boolean('remove_og_image') && $artikel->og_image) {
            Storage::disk('public')->delete($artikel->og_image);
            $validated['og_image'] = null;
        }

        unset($validated['og_image_upload']);

        $artikel->update($validated);

        return redirect()->route('admin.artikelen.edit', $artikel->id)
            ->with('success', 'Artikel succesvol bijgewerkt!');
    }

    public function destroy(string $id)
    {
        $artikel = Artikel::findOrFail($id);

        // Delete featured image
        if ($artikel->featured_image) {
            Storage::disk('public')->delete($artikel->featured_image);
        }

        // Delete OG/social image
        if ($artikel->og_image) {
            Storage::disk('public')->delete($artikel->og_image);
        }

        // Delete block images
        foreach ($artikel->content ?? [] as $block) {
            if ($block['type'] === 'image' && !empty($block['path'])) {
                Storage::disk('public')->delete($block['path']);
            }
            if ($block['type'] === 'text' && !empty($block['img_path'])) {
                Storage::disk('public')->delete($block['img_path']);
            }
        }

        $artikel->delete();

        return redirect()->route('admin.artikelen.index')
            ->with('success', 'Artikel succesvol verwijderd!');
    }

    /**
     * Process content blocks from request, handling image uploads.
     */
    private function processBlocks(Request $request, array $existingContent = []): array
    {
        $rawBlocks = $request->input('blocks', []);

        // Build a lookup of existing image paths by block index
        $existingImages = [];
        foreach ($existingContent as $idx => $block) {
            if ($block['type'] === 'image' && !empty($block['path'])) {
                $existingImages[$idx] = $block['path'];
            }
        }

        $blocks = [];
        foreach ($rawBlocks as $index => $block) {
            $type = $block['type'] ?? 'text';

            if ($type === 'text') {
                $html = trim($block['html'] ?? '');
                if ($html !== '') {
                    $entry = [
                        'type'   => 'text',
                        'html'   => $html,
                        'source' => trim($block['source'] ?? ''),
                        'indent' => !empty($block['indent']),
                    ];

                    // Optional inline image for this text block
                    $imgPath = $block['img_existing_path'] ?? null;

                    // Remove flag
                    if (!empty($block['img_remove']) && $imgPath) {
                        Storage::disk('public')->delete($imgPath);
                        $imgPath = null;
                    } elseif ($request->hasFile("blocks.$index.img_file")) {
                        if ($imgPath) {
                            Storage::disk('public')->delete($imgPath);
                        }
                        $imgPath = $request->file("blocks.$index.img_file")
                            ->store('artikelen', 'public');
                    }

                    if ($imgPath) {
                        $entry['img_path']    = $imgPath;
                        $entry['img_alt']     = trim($block['img_alt'] ?? '');
                        $entry['img_caption'] = trim($block['img_caption'] ?? '');
                        $entry['img_align']   = in_array($block['img_align'] ?? '', ['left', 'right', 'center', 'full'])
                                                    ? $block['img_align']
                                                    : 'right';
                        $entry['img_width']   = trim($block['img_width'] ?? '');
                    }

                    $blocks[] = $entry;
                }
            } elseif ($type === 'image') {
                $path = $block['existing_path'] ?? null;

                // Handle new file upload
                if ($request->hasFile("blocks.$index.file")) {
                    // If replacing an existing image, delete the old one
                    if ($path) {
                        Storage::disk('public')->delete($path);
                    }
                    $path = $request->file("blocks.$index.file")
                        ->store('artikelen', 'public');
                }

                if ($path) {
                    $blocks[] = [
                        'type'    => 'image',
                        'path'    => $path,
                        'alt'     => trim($block['alt'] ?? ''),
                        'caption' => trim($block['caption'] ?? ''),
                        'align'   => in_array($block['align'] ?? '', ['left', 'right', 'center', 'full'])
                                        ? $block['align']
                                        : 'center',
                        'width'   => trim($block['width'] ?? ''),
                    ];
                }
            }
        }

        return $blocks;
    }
}

