<?php

namespace Tests\Feature;

use App\Models\FinalCtaSection;
use App\Models\HomeService;
use App\Models\ProcessItem;
use App\Models\ProcessSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_services_page_reuses_active_home_service_process_and_cta_content_in_order(): void
    {
        HomeService::factory()->create([
            'title' => 'Second managed service',
            'sort_order' => 2,
        ]);
        HomeService::factory()->create([
            'title' => 'First managed service',
            'sort_order' => 1,
        ]);
        HomeService::factory()->create([
            'title' => 'Hidden managed service',
            'is_active' => false,
        ]);

        $section = ProcessSection::factory()->create([
            'label' => 'Managed Process',
            'title' => 'Managed process title',
            'description' => 'Managed process description.',
        ]);
        ProcessItem::factory()->for($section, 'section')->create([
            'label_number' => '02',
            'title' => 'Second managed process item',
            'sort_order' => 2,
        ]);
        ProcessItem::factory()->for($section, 'section')->create([
            'label_number' => '01',
            'title' => 'First managed process item',
            'sort_order' => 1,
        ]);
        ProcessItem::factory()->for($section, 'section')->create([
            'title' => 'Hidden managed process item',
            'is_active' => false,
        ]);

        FinalCtaSection::factory()->create([
            'label' => 'Managed CTA',
            'title' => 'Managed CTA title',
            'description' => 'Managed CTA description.',
            'primary_button_text' => 'Primary managed action',
            'secondary_button_text' => 'Secondary managed action',
        ]);

        $response = $this->get(route('services'));

        $response
            ->assertOk()
            ->assertSee('A complete organic growth system for Amazon')
            ->assertSeeInOrder(['First managed service', 'Second managed service'])
            ->assertDontSee('Hidden managed service')
            ->assertSee('Managed Process')
            ->assertSee('Managed process title')
            ->assertSee('Managed process description.')
            ->assertSeeInOrder(['First managed process item', 'Second managed process item'])
            ->assertDontSee('Hidden managed process item')
            ->assertSee('Managed CTA')
            ->assertSee('Managed CTA title')
            ->assertSee('Managed CTA description.')
            ->assertSee('Primary managed action')
            ->assertSee('Secondary managed action');
    }

    public function test_services_page_escapes_crud_content(): void
    {
        HomeService::factory()->create([
            'title' => '<script>serviceTitle()</script>',
            'short_description' => '<script>serviceDescription()</script>',
        ]);
        $section = ProcessSection::factory()->create([
            'label' => '<script>processLabel()</script>',
        ]);
        ProcessItem::factory()->for($section, 'section')->create([
            'title' => '<script>processTitle()</script>',
        ]);

        $response = $this->get(route('services'));

        $response
            ->assertOk()
            ->assertSee('&lt;script&gt;', false)
            ->assertDontSee('<script>', false);
    }

    public function test_legacy_services_url_redirects_to_the_named_services_page(): void
    {
        $response = $this->get('/services.html');

        $response
            ->assertMovedPermanently()
            ->assertRedirect(route('services'));
    }
}
