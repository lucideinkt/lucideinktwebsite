<?php

namespace App\Http\Controllers;

use App\Exports\PageSeoExport;
use App\Imports\PageSeoImport;
use App\Models\PageSeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
            'nieuwsbrief'          => ['label' => 'Nieuwsbrief',                'route' => 'nieuwsbrief',           'icon' => 'fa-newspaper'],
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

    public function export()
    {
        $pages      = self::manageablePages();
        $dbSettings = \App\Models\PageSeoSetting::whereIn('page_key', array_keys($pages))
            ->get()->keyBy('page_key');

        $exporter = new \App\Exports\PageSeoExport;
        $exporter->zipMode = true;

        // ── Collect images & build the zip-relative filename map ───────────
        $imageEntries = [];  // ['pageKey' => ['zipPath' => '...', 'absPath' => '...']]

        foreach ($pages as $pageKey => $pageInfo) {
            $db       = $dbSettings[$pageKey] ?? null;
            $defaults = \App\Services\SEOService::getPageConfigPublic($pageKey);

            // Effective image path (DB or default)
            $rawPath = $db?->og_image ?: \App\Exports\PageSeoExport::defaultImagePath($defaults);
            $absPath = \App\Exports\PageSeoExport::resolveAbsolutePath($rawPath);

            if ($absPath) {
                $ext     = strtolower(pathinfo($absPath, PATHINFO_EXTENSION));
                $zipPath = 'images/' . $pageKey . '.' . $ext;
                $imageEntries[$pageKey]              = ['zipPath' => $zipPath, 'absPath' => $absPath];
                $exporter->imageFilenames[$pageKey]  = $zipPath;
            }
        }

        // ── Generate the Excel into a temp file ────────────────────────────
        $xlsContent = Excel::raw($exporter, \Maatwebsite\Excel\Excel::XLSX);
        $xlsTmp = tempnam(sys_get_temp_dir(), 'seo_') . '.xlsx';
        file_put_contents($xlsTmp, $xlsContent);

        // ── Build ZIP ──────────────────────────────────────────────────────
        $zipTmp  = tempnam(sys_get_temp_dir(), 'seo_zip_') . '.zip';
        $zip     = new \ZipArchive;

        if ($zip->open($zipTmp, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Kon ZIP-bestand niet aanmaken.');
        }

        $zip->addFile($xlsTmp, 'pagina-seo.xlsx');

        foreach ($imageEntries as $pageKey => $entry) {
            $zip->addFile($entry['absPath'], $entry['zipPath']);
        }

        $zip->close();
        @unlink($xlsTmp);

        $filename = 'pagina-seo-' . now()->format('Y-m-d') . '.zip';

        return response()->download($zipTmp, $filename, [
            'Content-Type' => 'application/zip',
        ])->deleteFileAfterSend(true);
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls,csv,zip|max:20480',
        ], [
            'import_file.required' => 'Selecteer een bestand om te importeren.',
            'import_file.mimes'    => 'Alleen .xlsx, .xls, .csv of .zip bestanden zijn toegestaan.',
            'import_file.max'      => 'Bestand mag maximaal 20MB zijn.',
        ]);

        $file      = $request->file('import_file');
        $extension = strtolower($file->getClientOriginalExtension());
        $xlsPath   = null;
        $tmpDir    = null;

        if ($extension === 'zip') {
            // Extract the ZIP to a temp directory
            $tmpDir = sys_get_temp_dir() . '/seo_import_' . uniqid();
            mkdir($tmpDir, 0755, true);

            $zip = new \ZipArchive;
            if ($zip->open($file->getRealPath()) !== true) {
                return back()->withErrors(['import_file' => 'Kon het ZIP-bestand niet openen.']);
            }
            $zip->extractTo($tmpDir);
            $zip->close();

            $xlsPath = $tmpDir . '/pagina-seo.xlsx';
            if (!file_exists($xlsPath)) {
                // Try any xlsx inside
                $found = glob($tmpDir . '/*.xlsx');
                $xlsPath = $found[0] ?? null;
            }

            if (!$xlsPath || !file_exists($xlsPath)) {
                return back()->withErrors(['import_file' => 'Geen pagina-seo.xlsx gevonden in het ZIP-bestand.']);
            }
        } else {
            $xlsPath = $file->getRealPath();
        }

        // ── 1. Import Excel data first ─────────────────────────────────────
        $import = new \App\Imports\PageSeoImport;
        Excel::import($import, $xlsPath);

        // ── 2. Copy images from ZIP (overwrites og_image with correct path) ─
        if ($tmpDir) {
            $validPageKeys = array_keys(self::manageablePages());
            $imageDir = $tmpDir . '/images';
            if (is_dir($imageDir)) {
                foreach (scandir($imageDir) as $imgFile) {
                    if ($imgFile === '.' || $imgFile === '..') continue;
                    $pageKey = pathinfo($imgFile, PATHINFO_FILENAME);
                    if (!in_array($pageKey, $validPageKeys)) continue;

                    $srcPath  = $imageDir . '/' . $imgFile;
                    $destPath = 'seo/og/' . $imgFile;

                    Storage::disk('public')->putFileAs(
                        'seo/og',
                        new \Illuminate\Http\File($srcPath),
                        $imgFile
                    );

                    // Overwrite og_image with the correct storage path
                    \App\Models\PageSeoSetting::updateOrCreate(
                        ['page_key' => $pageKey],
                        ['og_image' => $destPath]
                    );
                }
            }
            $this->rmDir($tmpDir);
        }

        $message = $import->imported . ' pagina(\'s) bijgewerkt.';
        if (!empty($import->skipped)) {
            $message .= ' Overgeslagen (onbekende page_key): ' . implode(', ', $import->skipped) . '.';
        }

        return redirect()->route('admin.page-seo.index')->with('success', $message);
    }

    private function rmDir(string $dir): void
    {
        if (!is_dir($dir)) return;
        foreach (scandir($dir) as $item) {
            if ($item === '.' || $item === '..') continue;
            $path = $dir . '/' . $item;
            is_dir($path) ? $this->rmDir($path) : @unlink($path);
        }
        @rmdir($dir);
    }
}
