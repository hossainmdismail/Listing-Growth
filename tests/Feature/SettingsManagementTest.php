<?php

namespace Tests\Feature;

use App\Filament\Pages\GlobalSettings;
use App\Filament\Pages\MarketingSettings;
use App\Filament\Resources\SeoPages\Pages\CreateSeoPage;
use App\Filament\Resources\SeoPages\Pages\ListSeoPages;
use App\Models\GlobalSetting;
use App\Models\MarketingSetting;
use App\Models\SeoPage;
use App\Models\User;
use Database\Seeders\GlobalSettingSeeder;
use Database\Seeders\MarketingSettingSeeder;
use Database\Seeders\SeoPageSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class SettingsManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_settings_seeders_are_idempotent(): void
    {
        $this->seed([
            GlobalSettingSeeder::class,
            MarketingSettingSeeder::class,
            SeoPageSeeder::class,
        ]);

        $this->seed([
            GlobalSettingSeeder::class,
            MarketingSettingSeeder::class,
            SeoPageSeeder::class,
        ]);

        $this->assertSame(1, GlobalSetting::query()->count());
        $this->assertSame(1, MarketingSetting::query()->count());
        $this->assertSame(1, SeoPage::query()->where('page_key', 'home')->count());
    }

    public function test_filament_settings_and_seo_routes_are_registered(): void
    {
        $this->assertTrue(Route::has('filament.admin.pages.global-settings'));
        $this->assertTrue(Route::has('filament.admin.pages.marketing-settings'));
        $this->assertTrue(Route::has('filament.admin.resources.seo-pages.index'));
        $this->assertTrue(Route::has('filament.admin.resources.seo-pages.create'));
        $this->assertTrue(Route::has('filament.admin.resources.seo-pages.view'));
        $this->assertTrue(Route::has('filament.admin.resources.seo-pages.edit'));
    }

    public function test_public_upload_urls_use_the_current_browser_origin(): void
    {
        $this->assertSame('/storage/settings/logo.png', Storage::disk('public')->url('settings/logo.png'));
    }

    public function test_global_and_marketing_settings_can_be_saved_from_filament(): void
    {
        Livewire::test(GlobalSettings::class)
            ->set('data.site_name', 'Managed ListingGrowth')
            ->set('data.contact_email', 'managed@example.com')
            ->set('data.contact_phone', '+8801700000000')
            ->set('data.address', 'Dhaka, Bangladesh')
            ->set('data.default_robots_meta', 'index,follow')
            ->call('save')
            ->assertHasNoErrors();

        Livewire::test(MarketingSettings::class)
            ->set('data.ga4_enabled', true)
            ->set('data.ga4_measurement_id', 'G-MANAGED123')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas(GlobalSetting::class, [
            'site_name' => 'Managed ListingGrowth',
            'contact_email' => 'managed@example.com',
            'contact_phone' => '+8801700000000',
            'address' => 'Dhaka, Bangladesh',
        ]);
        $this->assertDatabaseHas(MarketingSetting::class, [
            'ga4_enabled' => true,
            'ga4_measurement_id' => 'G-MANAGED123',
        ]);
    }

    public function test_seo_page_can_be_created_and_listed_in_filament(): void
    {
        Livewire::test(CreateSeoPage::class)
            ->fillForm([
                'page_name' => 'Services',
                'page_key' => 'services',
                'page_type' => 'static',
                'meta_title' => 'Amazon SEO Services',
                'robots_index' => true,
                'robots_follow' => true,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $seoPage = SeoPage::query()->where('page_key', 'services')->firstOrFail();

        Livewire::test(ListSeoPages::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$seoPage]);
    }
}
