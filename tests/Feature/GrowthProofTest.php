<?php

namespace Tests\Feature;

use App\Filament\Pages\GrowthProofSettings;
use App\Models\GrowthProofItem;
use App\Models\GrowthProofSection;
use App\Models\GrowthProofStatistic;
use App\Models\User;
use Database\Seeders\GrowthProofItemSeeder;
use Database\Seeders\GrowthProofSectionSeeder;
use Database\Seeders\GrowthProofStatisticSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GrowthProofTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_section_items_and_statistics_are_managed_from_one_settings_page(): void
    {
        Livewire::test(GrowthProofSettings::class)
            ->fillForm([
                'label' => 'Managed proof label',
                'title' => 'Managed growth proof title',
                'items' => [
                    [
                        'label' => '01',
                        'title' => 'First managed item',
                        'description' => 'First managed item description.',
                        'is_active' => true,
                    ],
                    [
                        'label' => '02',
                        'title' => 'Second managed item',
                        'description' => 'Second managed item description.',
                        'is_active' => true,
                    ],
                ],
                'statistics' => [
                    [
                        'label' => 'Average improvement',
                        'value' => '90%',
                        'is_active' => true,
                    ],
                    [
                        'label' => 'Years of experience',
                        'value' => '10+',
                        'is_active' => true,
                    ],
                ],
            ])
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame(1, GrowthProofSection::query()->count());
        $this->assertDatabaseHas(GrowthProofSection::class, [
            'singleton_key' => 1,
            'label' => 'Managed proof label',
            'title' => 'Managed growth proof title',
        ]);
        $this->assertDatabaseHas(GrowthProofItem::class, [
            'label' => '01',
            'title' => 'First managed item',
        ]);
        $this->assertDatabaseHas(GrowthProofStatistic::class, [
            'label' => 'Average improvement',
            'value' => '90%',
        ]);
    }

    public function test_home_displays_only_active_items_and_statistics_in_order(): void
    {
        $section = GrowthProofSection::factory()->create([
            'label' => 'Dynamic proof label',
            'title' => 'Dynamic proof title',
        ]);

        GrowthProofItem::factory()->for($section, 'section')->create([
            'title' => 'Second proof item',
            'sort_order' => 2,
        ]);
        GrowthProofItem::factory()->for($section, 'section')->create([
            'title' => 'First proof item',
            'sort_order' => 1,
        ]);
        GrowthProofItem::factory()->for($section, 'section')->create([
            'title' => 'Hidden proof item',
            'is_active' => false,
        ]);
        GrowthProofStatistic::factory()->for($section, 'section')->create([
            'label' => 'Second statistic',
            'value' => '20%',
            'sort_order' => 2,
        ]);
        GrowthProofStatistic::factory()->for($section, 'section')->create([
            'label' => 'First statistic',
            'value' => '10%',
            'sort_order' => 1,
        ]);
        GrowthProofStatistic::factory()->for($section, 'section')->create([
            'label' => 'Hidden statistic',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertSee('Dynamic proof label')
            ->assertSee('Dynamic proof title')
            ->assertSeeInOrder(['First proof item', 'Second proof item'])
            ->assertSeeInOrder(['First statistic', 'Second statistic'])
            ->assertDontSee('Hidden proof item')
            ->assertDontSee('Hidden statistic');
    }

    public function test_growth_proof_seeders_are_idempotent(): void
    {
        $seeders = [
            GrowthProofSectionSeeder::class,
            GrowthProofItemSeeder::class,
            GrowthProofStatisticSeeder::class,
        ];

        $this->seed($seeders);
        $this->seed($seeders);

        $this->assertSame(1, GrowthProofSection::query()->count());
        $this->assertSame(4, GrowthProofItem::query()->count());
        $this->assertSame(4, GrowthProofStatistic::query()->count());
    }
}
