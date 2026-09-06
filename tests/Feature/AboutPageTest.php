<?php

namespace Tests\Feature;

use App\Models\FinalCtaSection;
use App\Models\Testimonial;
use App\Models\TestimonialSection;
use App\Models\TrustStatistic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_page_reuses_active_home_crud_content_in_order(): void
    {
        TrustStatistic::factory()->create([
            'field_name' => 'Second trust statistic',
            'field_value' => '200+',
            'sort_order' => 2,
        ]);
        TrustStatistic::factory()->create([
            'field_name' => 'First trust statistic',
            'field_value' => '100+',
            'sort_order' => 1,
        ]);
        TrustStatistic::factory()->create([
            'field_name' => 'Hidden trust statistic',
            'is_active' => false,
        ]);

        $section = TestimonialSection::factory()->create([
            'label' => 'Managed Testimonials',
            'title' => 'Managed testimonial title',
            'description' => 'Managed testimonial description.',
        ]);
        Testimonial::factory()->for($section, 'section')->create([
            'feedback' => 'Second managed feedback.',
            'name' => 'Second Client',
            'sort_order' => 2,
        ]);
        Testimonial::factory()->for($section, 'section')->create([
            'feedback' => 'First managed feedback.',
            'name' => 'First Client',
            'sort_order' => 1,
        ]);
        Testimonial::factory()->for($section, 'section')->create([
            'feedback' => 'Hidden managed feedback.',
            'is_active' => false,
        ]);

        FinalCtaSection::factory()->create([
            'label' => 'Managed CTA',
            'title' => 'Managed CTA title',
            'description' => 'Managed CTA description.',
            'primary_button_text' => 'Primary managed action',
            'secondary_button_text' => 'Secondary managed action',
        ]);

        $response = $this->get(route('about'));

        $response
            ->assertOk()
            ->assertSee('About ListingGrowth')
            ->assertSee("Built by people who've sat on both sides of the listing", false)
            ->assertSeeInOrder(['First trust statistic', 'Second trust statistic'])
            ->assertDontSee('Hidden trust statistic')
            ->assertSee('Managed Testimonials')
            ->assertSee('Managed testimonial title')
            ->assertSee('Managed testimonial description.')
            ->assertSeeInOrder(['First managed feedback.', 'Second managed feedback.'])
            ->assertDontSee('Hidden managed feedback.')
            ->assertSee('Managed CTA')
            ->assertSee('Managed CTA title')
            ->assertSee('Managed CTA description.')
            ->assertSee('Primary managed action')
            ->assertSee('Secondary managed action');
    }

    public function test_about_page_escapes_crud_content(): void
    {
        TrustStatistic::factory()->create([
            'field_name' => '<script>trustName()</script>',
            'field_value' => '<script>trustValue()</script>',
        ]);
        $section = TestimonialSection::factory()->create([
            'label' => '<script>sectionLabel()</script>',
        ]);
        Testimonial::factory()->for($section, 'section')->create([
            'feedback' => '<script>feedback()</script>',
            'name' => '<script>name()</script>',
        ]);

        $response = $this->get(route('about'));

        $response
            ->assertOk()
            ->assertSee('&lt;script&gt;', false)
            ->assertDontSee('<script>', false);
    }

    public function test_legacy_about_url_redirects_to_the_named_about_page(): void
    {
        $response = $this->get('/about.html');

        $response
            ->assertMovedPermanently()
            ->assertRedirect(route('about'));
    }
}
