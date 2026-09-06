<?php

namespace Tests\Feature;

use App\Filament\Pages\FaqSectionSettings;
use App\Models\FaqItem;
use App\Models\FaqSection;
use App\Models\User;
use Database\Seeders\FaqItemSeeder;
use Database\Seeders\FaqSectionSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FaqSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_section_and_faq_items_are_managed_from_one_settings_page(): void
    {
        Livewire::test(FaqSectionSettings::class)
            ->fillForm([
                'label' => 'Managed FAQs',
                'title' => 'Questions from our customers',
                'description' => 'Everything customers need to know.',
                'items' => [
                    [
                        'question' => 'How quickly can I get started?',
                        'answer' => 'You can start after the initial audit.',
                        'is_active' => true,
                        'show_on_contact_page' => false,
                    ],
                    [
                        'question' => 'Do you provide reports?',
                        'answer' => 'Yes, reports are provided regularly.',
                        'is_active' => true,
                        'show_on_contact_page' => true,
                    ],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(1, FaqSection::query()->count());
        $this->assertDatabaseHas(FaqSection::class, [
            'singleton_key' => 1,
            'label' => 'Managed FAQs',
            'title' => 'Questions from our customers',
        ]);
        $this->assertDatabaseCount(FaqItem::class, 2);
        $this->assertDatabaseHas(FaqItem::class, [
            'question' => 'How quickly can I get started?',
            'sort_order' => 1,
            'show_on_contact_page' => false,
        ]);
        $this->assertDatabaseHas(FaqItem::class, [
            'question' => 'Do you provide reports?',
            'show_on_contact_page' => true,
        ]);
    }

    public function test_home_displays_only_active_faq_items_in_order(): void
    {
        $section = FaqSection::factory()->create([
            'label' => 'Dynamic FAQs',
            'title' => 'Dynamic FAQ title',
            'description' => 'Dynamic FAQ description.',
        ]);
        FaqItem::factory()->for($section, 'section')->create([
            'question' => 'Second FAQ question?',
            'sort_order' => 2,
        ]);
        FaqItem::factory()->for($section, 'section')->create([
            'question' => 'First FAQ question?',
            'sort_order' => 1,
        ]);
        FaqItem::factory()->for($section, 'section')->create([
            'question' => 'Hidden FAQ question?',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Dynamic FAQs')
            ->assertSee('Dynamic FAQ title')
            ->assertSee('Dynamic FAQ description.')
            ->assertSeeInOrder(['First FAQ question?', 'Second FAQ question?'])
            ->assertDontSee('Hidden FAQ question?');
    }

    public function test_faq_content_is_escaped_on_the_homepage(): void
    {
        $section = FaqSection::factory()->create([
            'label' => '<script>sectionLabel()</script>',
            'title' => '<script>sectionTitle()</script>',
            'description' => '<script>sectionDescription()</script>',
        ]);
        FaqItem::factory()->for($section, 'section')->create([
            'question' => '<script>question()</script>',
            'answer' => '<script>answer()</script>',
        ]);

        $response = $this->get('/');

        $response
            ->assertSee('&lt;script&gt;', false)
            ->assertDontSee('<script>', false);
    }

    public function test_faq_seeders_are_idempotent(): void
    {
        $seeders = [
            FaqSectionSeeder::class,
            FaqItemSeeder::class,
        ];

        $this->seed($seeders);
        $this->seed($seeders);

        $this->assertSame(1, FaqSection::query()->count());
        $this->assertSame(5, FaqItem::query()->count());
    }
}
