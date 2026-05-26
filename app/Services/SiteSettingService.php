<?php

namespace App\Services;

use App\Models\SiteSetting;

class SiteSettingService
{
    const DEFAULTS = [
        'maintenance_mode' => '0',
        'mollie_mode'      => 'test',
        'mail_driver'      => 'smtp',
        'debug_info'       => '0',
        'allow_indexing'   => '0',
    ];

    public static function get(string $key, mixed $default = null): ?string
    {
        $fallback = $default ?? (self::DEFAULTS[$key] ?? null);

        try {
            return cache()->remember("site_setting_{$key}", now()->addMinutes(5), function () use ($key, $fallback) {
                return SiteSetting::find($key)?->value ?? $fallback;
            });
        } catch (\Throwable) {
            return $fallback;
        }
    }

    public static function set(string $key, mixed $value): void
    {
        try {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
            cache()->forget("site_setting_{$key}");
        } catch (\Throwable) {
            // DB not yet available
        }
    }

    public static function all(): array
    {
        try {
            $rows = SiteSetting::all()->pluck('value', 'key')->toArray();
            return array_merge(self::DEFAULTS, $rows);
        } catch (\Throwable) {
            return self::DEFAULTS;
        }
    }

    public static function isMaintenanceMode(): bool
    {
        return self::get('maintenance_mode') === '1';
    }

    public static function isMollieLive(): bool
    {
        return self::get('mollie_mode') === 'live';
    }

    public static function isMailtrap(): bool
    {
        return self::get('mail_driver') === 'mailtrap';
    }

    public static function isDebugInfo(): bool
    {
        return self::get('debug_info') === '1';
    }

    public static function isIndexingAllowed(): bool
    {
        return self::get('allow_indexing') === '1';
    }
}

