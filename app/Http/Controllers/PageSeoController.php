<?php

namespace App\Http\Controllers;

use App\Models\PageSeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSeoController extends Controller
{
    /**
     * All manageable pages with their labels and routes.
     */
    public static function manageablePages(): array
    {
        return [
            'home'                 => ['label' => 'Homepage',                   'route' => 'home',                  'icon' => 'fa-house'],
            'saidnursi'            => ['label' => 'Said Nursi',                 'route' => 'saidnursi',             'icon' => 'fa-user'],
            'risale'               => ['label' => 'Risale-i Nur',               'route' => 'risale',                'icon' => 'fa-book-open'],
            'herzameling'          => ['label' => 'Herzameling',                'route' => 'herzameling',           'icon' => 'fa-book-open'],
            'contact'              => ['label' => 'Contact',                    'route' => 'contact',               'icon' => 'fa-envelope'],
            'shop'                 => ['label' => 'Winkel',                     'route' => 'shop',                  'icon' => 'fa-store'],
            'online-lezen'         => ['label' => 'Online Bibliotheek',         'route' => 'onlineLezen',           'icon' => 'fa-book-reader'],
            'audiobooks'           => ['label' => 'Audio Bibliotheek',          'route' => 'audiobooks',            'icon' => 'fa-headphones'],
            'algemene-voorwaarden' => ['label' => 'Algemene Voorwaarden',       'route' => 'algemeneVoorwaarden',   'icon' => 'fa-file-contract'],
            'privacybeleid'        => ['label' => 'Privacybeleid',              'route' => 'privacybeleid',         'icon' => 'fa-shield-halved'],
            'retourbeleid'         => ['label' => 'Retourbeleid',               'route' => 'retourbeleid',          'icon' => 'fa-rotate-left'],
            'verzending-levering'  => ['label' => 'Verzending & Levering',      'route' => 'verzendingLevering',    'icon' => 'fa-truck'],
        ];
    }

    public function index()
    {
        $pages = self::manageablePages();
        $dbSettings = PageSeoSetting::whereIn('page_key', array_keys($pages))->get()->keyBy('page_key');

        return view('admin.page-seo.index', compact('pages', 'dbSettings'));
    }

    public function edit(string $pageKey)
    {
        $pages = self::manageablePages();

        if (! array_key_exists($pageKey, $pages)) {
            abort(404);
        }

        $pageInfo = $pages[$pageKey];
        $setting  = PageSeoSetting::firstOrNew(['page_key' => $pageKey]);

        // Load defaults from SEOService config for display
        $service   = new \App\Services\SEOService;
        $defaults  = \App\Services\SEOService::getPageConfigPublic($pageKey);

        return view('admin.page-seo.edit', compact('pageKey', 'pageInfo', 'setting', 'defaults'));
    }

    public function update(Request $request, string $pageKey)
    {
        $pages = self::manageablePages();

        if (! array_key_exists($pageKey, $pages)) {
            abort(404);
        }

        $validated = $request->validate([
            'title'           => 'nullable|string|max:70',
            'description'     => 'nullable|string|max:320',
            'author'          => 'nullable|string|max:100',
            'robots'          => 'nullable|string|max:100',
            'canonical_url'   => 'nullable|url|max:500',
            'og_image'        => 'nullable|string|max:500',
            'og_image_upload' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'delete_og_image' => 'nullable|boolean',
            'type'            => 'nullable|string|max:50',
        ]);

        $setting = PageSeoSetting::firstOrNew(['page_key' => $pageKey]);

        // Handle image deletion
        if ($request->boolean('delete_og_image')) {
            if ($setting->og_image && str_starts_with($setting->og_image, 'seo/og/')) {
                Storage::disk('public')->delete($setting->og_image);
            }
            $validated['og_image'] = null;
        }

        // Handle new image upload (takes precedence over manual path)
        if ($request->hasFile('og_image_upload') && $request->file('og_image_upload')->isValid()) {
            // Delete old uploaded file if it was one
            if ($setting->og_image && str_starts_with($setting->og_image, 'seo/og/')) {
                Storage::disk('public')->delete($setting->og_image);
            }
            $path = $request->file('og_image_upload')->store('seo/og', 'public');
            $validated['og_image'] = $path;
        }

        unset($validated['og_image_upload'], $validated['delete_og_image']);

        $setting->fill($validated);
        $setting->page_key = $pageKey;
        $setting->save();

        return redirect()->route('admin.page-seo.index')
            ->with('success', 'SEO-instellingen voor "' . $pages[$pageKey]['label'] . '" opgeslagen.');
    }
}

