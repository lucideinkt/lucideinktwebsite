<?php

namespace Tests\Unit;

use App\Services\SiteSettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SiteSettingServiceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function indexing_is_blocked_by_default(): void
    {
        $this->assertFalse(SiteSettingService::isIndexingAllowed());
    }

    #[Test]
    public function indexing_is_allowed_when_setting_is_1(): void
    {
        SiteSettingService::set('allow_indexing', '1');
        cache()->forget('site_setting_allow_indexing');

        $this->assertTrue(SiteSettingService::isIndexingAllowed());
    }

    #[Test]
    public function indexing_is_blocked_when_setting_is_0(): void
    {
        SiteSettingService::set('allow_indexing', '1');
        cache()->forget('site_setting_allow_indexing');

        SiteSettingService::set('allow_indexing', '0');
        cache()->forget('site_setting_allow_indexing');

        $this->assertFalse(SiteSettingService::isIndexingAllowed());
    }

    #[Test]
    public function set_persists_value_in_database(): void
    {
        SiteSettingService::set('allow_indexing', '1');

        $this->assertDatabaseHas('site_settings', [
            'key'   => 'allow_indexing',
            'value' => '1',
        ]);
    }

    #[Test]
    public function set_overwrites_existing_value(): void
    {
        SiteSettingService::set('allow_indexing', '1');
        SiteSettingService::set('allow_indexing', '0');

        $this->assertDatabaseHas('site_settings', [
            'key'   => 'allow_indexing',
            'value' => '0',
        ]);
    }
}
