<?php

namespace Tests\Feature;

use App\Models\GlobalSetting;
use App\Models\MarketingSetting;
use App\Models\SeoPage;
use App\Support\SeoMetadata;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoMetadataTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_database_seo_and_enabled_marketing_data(): void
    {
        GlobalSetting::factory()->create([
            'site_name' => 'ListingGrowth Database',
            'canonical_base_url' => 'https://listinggrowth.test',
        ]);

        SeoPage::factory()->create([
            'page_key' => 'home',
            'meta_title' => 'Database SEO title',
            'meta_description' => 'Database SEO description',
            'canonical_url' => null,
            'robots_index' => false,
            'robots_follow' => true,
        ]);

        MarketingSetting::factory()->create([
            'ga4_enabled' => true,
            'ga4_measurement_id' => 'G-TEST123',
            'google_search_console_verification' => 'google-test-code',
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('<title>Database SEO title</title>', false)
            ->assertSee('content="Database SEO description"', false)
            ->assertSee('content="noindex,follow"', false)
            ->assertSee('href="https://listinggrowth.test"', false)
            ->assertSee('G-TEST123')
            ->assertSee('google-test-code');
    }

    public function test_view_fallbacks_take_priority_over_global_defaults_for_dynamic_pages(): void
    {
        GlobalSetting::factory()->create([
            'default_meta_title' => 'Global title',
            'default_meta_description' => 'Global description',
        ]);

        $metadata = app(SeoMetadata::class)->resolve(null, [
            'title' => 'Dynamic record title',
            'description' => 'Dynamic record description',
        ]);

        $this->assertSame('Dynamic record title', $metadata['title']);
        $this->assertSame('Dynamic record description', $metadata['description']);
        $this->assertSame('Dynamic record title', $metadata['twitter_title']);
        $this->assertSame('Dynamic record description', $metadata['twitter_description']);
    }

    public function test_inactive_page_seo_falls_back_to_global_settings(): void
    {
        GlobalSetting::factory()->create([
            'default_meta_title' => 'Global fallback title',
        ]);

        SeoPage::factory()->create([
            'page_key' => 'hidden-page',
            'meta_title' => 'Inactive title',
            'is_active' => false,
        ]);

        $metadata = app(SeoMetadata::class)->resolve('hidden-page');

        $this->assertSame('Global fallback title', $metadata['title']);
    }
}
