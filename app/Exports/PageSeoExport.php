<?php

namespace App\Exports;

use App\Http\Controllers\PageSeoController;
use App\Models\PageSeoSetting;
use App\Services\SEOService;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PageSeoExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    /**
     * When true, the og_image column uses a zip-relative path like images/home.jpg.
     * When false, it uses the raw stored path.
     */
    public bool $zipMode = false;

    /** Map of page_key => zip-relative image filename (populated before export) */
    public array $imageFilenames = [];

    public function title(): string
    {
        return 'Pagina SEO';
    }

    public function headings(): array
    {
        return [
            'page_key',
            'title',
            'description',
            'author',
            'robots',
            'canonical_url',
            'og_image',
            'type',
        ];
    }

    public function collection()
    {
        $pages      = PageSeoController::manageablePages();
        $dbSettings = PageSeoSetting::whereIn('page_key', array_keys($pages))
            ->get()
            ->keyBy('page_key');

        $rows = collect();

        foreach ($pages as $pageKey => $pageInfo) {
            $db       = $dbSettings[$pageKey] ?? null;
            $defaults = SEOService::getPageConfigPublic($pageKey);

            // Effective values: DB override first, then default
            $title       = $db?->title       ?: ($defaults['title']       ?? '');
            $description = $db?->description ?: ($defaults['description'] ?? '');
            $author      = $db?->author      ?: 'Lucide Inkt';
            $robots      = $db?->robots      ?: ($defaults['robots']      ?? 'index, follow');
            $canonicalUrl= $db?->canonical_url ?: ($defaults['url']       ?? '');
            $type        = $db?->type        ?: ($defaults['type']        ?? 'website');

            // Image column
            if ($this->zipMode) {
                $ogImage = $this->imageFilenames[$pageKey] ?? '';
            } else {
                // Raw path — DB value or default public path
                $ogImage = $db?->og_image ?: self::defaultImagePath($defaults);
            }

            $rows->push([
                'page_key'      => $pageKey,
                'title'         => $title,
                'description'   => $description,
                'author'        => $author,
                'robots'        => $robots,
                'canonical_url' => $canonicalUrl,
                'og_image'      => $ogImage,
                'type'          => $type,
            ]);
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF1F2937'],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22,  // page_key
            'B' => 60,  // title
            'C' => 85,  // description
            'D' => 20,  // author
            'E' => 22,  // robots
            'F' => 45,  // canonical_url
            'G' => 40,  // og_image
            'H' => 12,  // type
        ];
    }

    /**
     * Resolve the filesystem path of the default image for a page config.
     * Returns a relative public path like "images/social_share_logo.jpg".
     */
    public static function defaultImagePath(array $defaults): string
    {
        if (empty($defaults['image'])) {
            return SEOService::DEFAULT_OG_IMAGE;
        }
        // Strip the host part to get a relative path like "images/social_share_logo.jpg"
        $path = parse_url($defaults['image'], PHP_URL_PATH);
        return ltrim($path, '/');
    }

    /**
     * Resolve the absolute filesystem path for a given og_image value.
     * Handles both uploaded files (seo/og/…) and public image paths.
     */
    public static function resolveAbsolutePath(string $ogImage): ?string
    {
        if (str_starts_with($ogImage, 'seo/og/')) {
            $abs = Storage::disk('public')->path($ogImage);
            return file_exists($abs) ? $abs : null;
        }
        $abs = public_path($ogImage);
        return file_exists($abs) ? $abs : null;
    }
}
