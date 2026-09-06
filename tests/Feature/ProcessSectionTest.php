<?php

namespace Tests\Feature;

use App\Filament\Pages\ProcessSectionSettings;
use App\Models\ProcessItem;
use App\Models\ProcessSection;
use App\Models\User;
use Database\Seeders\ProcessItemSeeder;
use Database\Seeders\ProcessSectionSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProcessSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_section_and_process_items_are_managed_from_one_settings_page(): void
    {
        Livewire::test(ProcessSectionSettings::class)
            ->fillForm([
                'label' => 'Our Managed Process',
                'title' => 'Research. Test. Grow.',
                'description' => 'A managed process description.',
                'items' => [
                    [
                        'label_number' => '01',
                        'title' => 'Research the market',
                        'description' => 'Find the best market opportunity.',
                        'is_active' => true,
                    ],
                    [
                        'label_number' => '02',
                        'title' => 'Test with shoppers',
                        'description' => 'Collect genuine shopper feedback.',
                        'is_active' => true,
                    ],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(1, ProcessSection::query()->count());
        $this->assertDatabaseHas(ProcessSection::class, [
            'singleton_key' => 1,
            'label' => 'Our Managed Process',
            'title' => 'Research. Test. Grow.',
        ]);
        $this->assertDatabaseCount(ProcessItem::class, 2);
        $this->assertDatabaseHas(ProcessItem::class, [
            'label_number' => '01',
            'title' => 'Research the market',
            'sort_order' => 1,
        ]);
    }

    public function test_home_displays_only_active_process_items_in_order(): void
    {
        $section = ProcessSection::factory()->create([
            'label' => 'Dynamic Process',
            'title' => 'Dynamic process title',
            'description' => 'Dynamic process description.',
        ]);
        ProcessItem::factory()->for($section, 'section')->create([
            'label_number' => '02',
            'title' => 'Second process item',
            'sort_order' => 2,
        ]);
        ProcessItem::factory()->for($section, 'section')->create([
            'label_number' => '01',
            'title' => 'First process item',
            'sort_order' => 1,
        ]);
        ProcessItem::factory()->for($section, 'section')->create([
            'title' => 'Hidden process item',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Dynamic Process')
            ->assertSee('Dynamic process title')
            ->assertSee('Dynamic process description.')
            ->assertSeeInOrder(['First process item', 'Second process item'])
            ->assertDontSee('Hidden process item');
    }

    public function test_process_content_is_escaped_on_the_homepage(): void
    {
        $section = ProcessSection::factory()->create([
            'label' => '<script>sectionLabel()</script>',
            'title' => '<script>sectionTitle()</script>',
            'description' => '<script>sectionDescription()</script>',
        ]);
        ProcessItem::factory()->for($section, 'section')->create([
            'label_number' => '<script>number()</script>',
            'title' => '<script>itemTitle()</script>',
            'description' => '<script>itemDescription()</script>',
        ]);

        $response = $this->get('/');

        $response
            ->assertSee('&lt;script&gt;', false)
            ->assertDontSee('<script>', false);
    }

    public function test_process_seeders_are_idempotent(): void
    {
        $seeders = [
            ProcessSectionSeeder::class,
            ProcessItemSeeder::class,
        ];

        $this->seed($seeders);
        $this->seed($seeders);

        $this->assertSame(1, ProcessSection::query()->count());
        $this->assertSame(4, ProcessItem::query()->count());
    }
}
