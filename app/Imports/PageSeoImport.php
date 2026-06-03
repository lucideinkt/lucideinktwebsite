<?php

namespace App\Imports;

use App\Http\Controllers\PageSeoController;
use App\Models\PageSeoSetting;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class PageSeoImport implements ToCollection, WithHeadingRow
{
    public int $imported = 0;
    public array $skipped = [];

    public function collection(Collection $collection): void
    {
        $validPageKeys = array_keys(PageSeoController::manageablePages());

        foreach ($collection as $row) {
            $pageKey = trim((string) ($row['page_key'] ?? ''));

            if (empty($pageKey) || !in_array($pageKey, $validPageKeys)) {
                if (!empty($pageKey)) {
                    $this->skipped[] = $pageKey;
                }
                continue;
            }

            // Treat whitespace-only strings as null
            $nullify = fn (?string $v): ?string => filled(trim((string) $v)) ? trim((string) $v) : null;

            $setting = PageSeoSetting::firstOrNew(['page_key' => $pageKey]);
            $setting->title         = $nullify($row['title'] ?? null);
            $setting->description   = $nullify($row['description'] ?? null);
            $setting->author        = $nullify($row['author'] ?? null);
            $setting->robots        = $nullify($row['robots'] ?? null);
            $setting->canonical_url = $nullify($row['canonical_url'] ?? null);
            $setting->og_image      = $nullify($row['og_image'] ?? null);
            $setting->type          = $nullify($row['type'] ?? null);
            $setting->save();

            $this->imported++;
        }
    }
}


