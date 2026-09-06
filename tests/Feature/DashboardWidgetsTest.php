<?php

namespace Tests\Feature;

use App\Filament\Resources\HomeServices\HomeServiceResource;
use App\Filament\Widgets\ContentOverview;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\SiteSettingsWidget;
use App\Filament\Widgets\WebsiteLinkWidget;
use App\Models\ContactSubmission;
use App\Models\HomeService;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardWidgetsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.env' => 'local']);
        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_dashboard_renders_all_project_widget_groups(): void
    {
        $response = $this->get('/admin');

        $response
            ->assertOk()
            ->assertSee('Visit Website')
            ->assertSee('Content Overview')
            ->assertSee('Quick Actions')
            ->assertSee('Site Settings');
    }

    public function test_content_overview_displays_total_and_state_counts(): void
    {
        HomeService::factory()->count(2)->create();
        HomeService::factory()->create(['is_active' => false]);
        ContactSubmission::factory()->create(['status' => ContactSubmission::STATUS_NEW]);
        ContactSubmission::factory()->create(['status' => ContactSubmission::STATUS_CLOSED]);

        Livewire::test(ContentOverview::class)
            ->assertOk()
            ->assertSeeInOrder(['Contact Submissions', '2', '1 new'])
            ->assertSeeInOrder(['Home Services', '3', '2 active'])
            ->assertSee('Growth Proof Statistics')
            ->assertSee('SEO Pages');
    }

    public function test_quick_actions_link_to_available_content_managers(): void
    {
        Livewire::test(QuickActionsWidget::class)
            ->assertOk()
            ->assertSee('Contact Submissions')
            ->assertSee('Home Services')
            ->assertSee(HomeServiceResource::getUrl())
            ->assertSee(HomeServiceResource::getUrl('create'))
            ->assertSee('Growth Proof')
            ->assertSee('Testimonials')
            ->assertSee('Case Studies')
            ->assertSee('FAQs')
            ->assertSee('Final CTA');
    }

    public function test_site_and_website_widgets_render_management_links(): void
    {
        Livewire::test(WebsiteLinkWidget::class)
            ->assertOk()
            ->assertSee('Visit Website')
            ->assertSee(route('home'));

        Livewire::test(SiteSettingsWidget::class)
            ->assertOk()
            ->assertSee('Global Settings')
            ->assertSee('Marketing Settings')
            ->assertSee('SEO Pages');
    }
}
