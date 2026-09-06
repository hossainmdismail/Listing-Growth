<?php

namespace Tests\Feature;

use App\Filament\Pages\CategorySectionSettings;
use App\Models\CategorySection;
use App\Models\HomeCategory;
use App\Models\User;
use Database\Seeders\CategorySectionSeeder;
use Database\Seeders\HomeCategorySeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategorySectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_section_and_categories_are_managed_from_one_settings_page(): void
    {
        Livewire::test(CategorySectionSettings::class)
            ->fillForm([
                'label' => 'Managed Categories',
                'title' => 'Managed category section title',
                'description' => 'Managed category section description.',
                'categories' => [
                    [
                        'name' => 'Home & Kitchen',
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Electronics',
                        'is_active' => true,
                    ],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(1, CategorySection::query()->count());
        $this->assertDatabaseHas(CategorySection::class, [
            'singleton_key' => 1,
            'label' => 'Managed Categories',
            'title' => 'Managed category section title',
        ]);
        $this->assertDatabaseCount(HomeCategory::class, 2);
        $this->assertDatabaseHas(HomeCategory::class, ['name' => 'Home & Kitchen']);
        $this->assertDatabaseHas(HomeCategory::class, ['name' => 'Electronics']);
    }

    public function test_home_displays_only_active_categories_in_order(): void
    {
        $section = CategorySection::factory()->create([
            'label' => 'Dynamic Categories',
            'title' => 'Dynamic category title',
            'description' => 'Dynamic category description.',
        ]);

        HomeCategory::factory()->for($section, 'section')->create([
            'name' => 'Second Category',
            'sort_order' => 2,
        ]);
        HomeCategory::factory()->for($section, 'section')->create([
            'name' => 'First Category',
            'sort_order' => 1,
        ]);
        HomeCategory::factory()->for($section, 'section')->create([
            'name' => 'Hidden Category',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertSee('Dynamic Categories')
            ->assertSee('Dynamic category title')
            ->assertSee('Dynamic category description.')
            ->assertSeeInOrder(['First Category', 'Second Category'])
            ->assertDontSee('Hidden Category');
    }

    public function test_category_seeders_are_idempotent(): void
    {
        $seeders = [
            CategorySectionSeeder::class,
            HomeCategorySeeder::class,
        ];

        $this->seed($seeders);
        $this->seed($seeders);

        $this->assertSame(1, CategorySection::query()->count());
        $this->assertSame(12, HomeCategory::query()->count());
    }
}
