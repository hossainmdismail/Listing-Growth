<?php

namespace Tests\Feature;

use App\Filament\Pages\FinalCtaSettings;
use App\Models\FinalCtaSection;
use App\Models\User;
use Database\Seeders\FinalCtaSectionSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FinalCtaSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_final_cta_is_managed_as_a_single_section(): void
    {
        Livewire::test(FinalCtaSettings::class)
            ->fillForm([
                'label' => 'Start Today',
                'title' => 'Grow your Amazon business.',
                'description' => 'Get a tailored growth plan.',
                'primary_button_text' => 'Get a Free Audit',
                'primary_button_url' => '/free-audit',
                'secondary_button_text' => 'Book a Call',
                'secondary_button_url' => 'https://example.com/book',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        Livewire::test(FinalCtaSettings::class)
            ->set('data.title', 'Updated CTA title')
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(1, FinalCtaSection::query()->count());
        $this->assertDatabaseHas(FinalCtaSection::class, [
            'singleton_key' => 1,
            'title' => 'Updated CTA title',
            'primary_button_text' => 'Get a Free Audit',
            'primary_button_url' => '/free-audit',
            'secondary_button_text' => 'Book a Call',
            'secondary_button_url' => 'https://example.com/book',
        ]);
    }

    public function test_home_displays_final_cta_content_and_both_buttons(): void
    {
        FinalCtaSection::factory()->create([
            'label' => 'Dynamic CTA',
            'title' => "Dynamic CTA title.\nSecond line.",
            'description' => 'Dynamic CTA description.',
            'primary_button_text' => 'Primary Action',
            'primary_button_url' => '/primary-action',
            'secondary_button_text' => 'Secondary Action',
            'secondary_button_url' => 'https://example.com/secondary-action',
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Dynamic CTA')
            ->assertSee("Dynamic CTA title.\nSecond line.")
            ->assertSee('Dynamic CTA description.')
            ->assertSee('href="/primary-action"', false)
            ->assertSee('Primary Action')
            ->assertSee('href="https://example.com/secondary-action"', false)
            ->assertSee('Secondary Action');
    }

    public function test_home_escapes_cta_content_and_rejects_unsafe_button_urls(): void
    {
        FinalCtaSection::factory()->create([
            'label' => '<script>label()</script>',
            'title' => '<script>title()</script>',
            'description' => '<script>description()</script>',
            'primary_button_text' => '<script>primary()</script>',
            'primary_button_url' => 'javascript:alert(1)',
            'secondary_button_text' => '<script>secondary()</script>',
            'secondary_button_url' => 'data:text/html,unsafe',
        ]);

        $response = $this->get('/');

        $response
            ->assertSee('&lt;script&gt;', false)
            ->assertSee('href="#"', false)
            ->assertDontSee('<script>', false)
            ->assertDontSee('javascript:', false)
            ->assertDontSee('data:text/html', false);
    }

    public function test_final_cta_seeder_is_idempotent(): void
    {
        $this->seed(FinalCtaSectionSeeder::class);
        $this->seed(FinalCtaSectionSeeder::class);

        $this->assertSame(1, FinalCtaSection::query()->count());
    }
}
