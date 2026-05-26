<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\SiteSettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoIndexingToggleTest extends TestCase
{
    use RefreshDatabase;

    // ──────────────────────────────────────────────
    // robots.txt
    // ──────────────────────────────────────────────

    /** @test */
    public function robots_txt_blocks_all_when_indexing_is_disabled(): void
    {
        SiteSettingService::set('allow_indexing', '0');
        cache()->forget('site_setting_allow_indexing');

        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $response->assertSee('Disallow: /');
        $response->assertDontSee('Allow: /');
        $response->assertSee('noindex', false); // comment in robots.txt
    }

    /** @test */
    public function robots_txt_allows_indexing_when_enabled(): void
    {
        SiteSettingService::set('allow_indexing', '1');
        cache()->forget('site_setting_allow_indexing');

        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $response->assertSee('Allow: /');
        $response->assertSee('Disallow: /dashboard');
        $response->assertSee('sitemap.xml');
        $response->assertDontSee('Disallow: /'."\n"); // not blocking everything
    }

    // ──────────────────────────────────────────────
    // Admin toggle via form POST
    // ──────────────────────────────────────────────

    /** @test */
    public function admin_can_enable_seo_indexing(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('admin.settings.update'), [
            'allow_indexing' => '1',
            'mollie_mode'    => 'test',
            'mail_driver'    => 'smtp',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        cache()->forget('site_setting_allow_indexing');
        $this->assertTrue(SiteSettingService::isIndexingAllowed());
        $this->assertDatabaseHas('site_settings', ['key' => 'allow_indexing', 'value' => '1']);
    }

    /** @test */
    public function admin_can_disable_seo_indexing(): void
    {
        // Start with indexing on
        SiteSettingService::set('allow_indexing', '1');
        cache()->forget('site_setting_allow_indexing');

        $admin = User::factory()->create(['role' => 'admin']);

        // Submit form WITHOUT allow_indexing (unchecked checkbox → defaults to 0)
        $response = $this->actingAs($admin)->post(route('admin.settings.update'), [
            'mollie_mode' => 'test',
            'mail_driver' => 'smtp',
            // allow_indexing intentionally omitted — simulates unchecked checkbox
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        cache()->forget('site_setting_allow_indexing');
        $this->assertFalse(SiteSettingService::isIndexingAllowed());
        $this->assertDatabaseHas('site_settings', ['key' => 'allow_indexing', 'value' => '0']);
    }

    /** @test */
    public function guest_cannot_change_seo_indexing(): void
    {
        $response = $this->post(route('admin.settings.update'), [
            'allow_indexing' => '1',
            'mollie_mode'    => 'test',
            'mail_driver'    => 'smtp',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertFalse(SiteSettingService::isIndexingAllowed());
    }

    /** @test */
    public function regular_user_cannot_change_seo_indexing(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->post(route('admin.settings.update'), [
            'allow_indexing' => '1',
            'mollie_mode'    => 'test',
            'mail_driver'    => 'smtp',
        ]);

        $response->assertForbidden();
        $this->assertFalse(SiteSettingService::isIndexingAllowed());
    }

    // ──────────────────────────────────────────────
    // Settings page visibility
    // ──────────────────────────────────────────────

    /** @test */
    public function settings_page_shows_indexing_as_blocked_by_default(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.settings'));

        $response->assertStatus(200);
        $response->assertSee('allow_indexing');
    }
}

