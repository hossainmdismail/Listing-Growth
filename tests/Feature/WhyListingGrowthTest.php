<?php

namespace Tests\Feature;

use App\Filament\Pages\WhyListingGrowthSettings;
use App\Filament\Resources\WhyListingGrowthItems\Pages\CreateWhyListingGrowthItem;
use App\Filament\Resources\WhyListingGrowthItems\Pages\EditWhyListingGrowthItem;
use App\Filament\Resources\WhyListingGrowthItems\Pages\ListWhyListingGrowthItems;
use App\Filament\Resources\WhyListingGrowthItems\Pages\ViewWhyListingGrowthItem;
use App\Filament\Resources\WhyListingGrowthItems\WhyListingGrowthItemResource;
use App\Models\User;
use App\Models\WhyListingGrowthItem;
use App\Models\WhyListingGrowthSection;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WhyListingGrowthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_section_settings_save_without_creating_another_section(): void
    {
        Livewire::test(WhyListingGrowthSettings::class)
            ->set('data.section_label', 'Why ListingGrowth')
            ->set('data.title', 'A faster path to Page 1')
            ->set('data.description', 'A managed organic growth system.')
            ->call('save')
            ->assertHasNoErrors();

        Livewire::test(WhyListingGrowthSettings::class)
            ->set('data.title', 'Updated section title')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame(1, WhyListingGrowthSection::query()->count());
        $this->assertDatabaseHas(WhyListingGrowthSection::class, [
            'singleton_key' => 1,
            'title' => 'Updated section title',
        ]);
    }

    public function test_section_items_are_managed_inside_the_settings_page(): void
    {
        Livewire::test(WhyListingGrowthSettings::class)
            ->fillForm([
                'section_label' => 'Why ListingGrowth',
                'title' => 'Months to rank? Not with us.',
                'description' => 'We build the system that keeps products on Page 1.',
                'items' => [
                    [
                        'label' => 'Rank',
                        'title' => 'Rank #1 for your top keywords',
                        'description' => 'Build lasting organic authority.',
                        'is_active' => true,
                    ],
                    [
                        'label' => 'Compete',
                        'title' => 'Grow lean, beat bigger rivals',
                        'description' => 'Outrank competitors efficiently.',
                        'is_active' => true,
                    ],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertFalse(WhyListingGrowthItemResource::shouldRegisterNavigation());
        $this->assertDatabaseCount(WhyListingGrowthItem::class, 2);
        $this->assertDatabaseHas(WhyListingGrowthItem::class, [
            'label' => 'Rank',
            'title' => 'Rank #1 for your top keywords',
        ]);
        $this->assertDatabaseHas(WhyListingGrowthItem::class, [
            'label' => 'Compete',
            'title' => 'Grow lean, beat bigger rivals',
        ]);
    }

    public function test_home_displays_active_why_items_in_order(): void
    {
        $section = WhyListingGrowthSection::factory()->create([
            'title' => 'Managed section title',
            'description' => 'Managed section description.',
        ]);

        WhyListingGrowthItem::factory()->for($section, 'section')->create([
            'label' => 'Second',
            'title' => 'Second item title',
            'sort_order' => 2,
        ]);
        WhyListingGrowthItem::factory()->for($section, 'section')->create([
            'label' => 'First',
            'title' => 'First item title',
            'sort_order' => 1,
        ]);
        WhyListingGrowthItem::factory()->for($section, 'section')->create([
            'title' => 'Hidden item title',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertSee('Managed section title')
            ->assertSee('Managed section description.')
            ->assertSeeInOrder(['First item title', 'Second item title'])
            ->assertDontSee('Hidden item title');
    }

    public function test_why_item_can_be_created_viewed_and_listed_in_filament(): void
    {
        Livewire::test(CreateWhyListingGrowthItem::class)
            ->fillForm([
                'label' => 'Rank',
                'title' => 'Rank #1 for your top keywords',
                'description' => 'Organic rank builds lasting brand authority.',
                'sort_order' => 1,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $item = WhyListingGrowthItem::query()->where('label', 'Rank')->firstOrFail();

        $this->assertSame(WhyListingGrowthSection::singleton()->id, $item->why_listing_growth_section_id);

        Livewire::test(ListWhyListingGrowthItems::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$item]);

        Livewire::test(ViewWhyListingGrowthItem::class, ['record' => $item->getRouteKey()])
            ->assertOk()
            ->assertSchemaStateSet([
                'label' => 'Rank',
                'title' => 'Rank #1 for your top keywords',
            ]);
    }

    public function test_why_item_can_be_updated_and_deleted_in_filament(): void
    {
        $section = WhyListingGrowthSection::factory()->create();
        $item = WhyListingGrowthItem::factory()->for($section, 'section')->create([
            'title' => 'Old item title',
        ]);

        Livewire::test(EditWhyListingGrowthItem::class, ['record' => $item->getRouteKey()])
            ->fillForm([
                'label' => 'Updated',
                'title' => 'Updated item title',
                'description' => 'Updated item description.',
                'sort_order' => 5,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(WhyListingGrowthItem::class, [
            'id' => $item->id,
            'title' => 'Updated item title',
            'sort_order' => 5,
        ]);

        Livewire::test(EditWhyListingGrowthItem::class, ['record' => $item->getRouteKey()])
            ->callAction(DeleteAction::class)
            ->assertRedirect();

        $this->assertDatabaseMissing(WhyListingGrowthItem::class, ['id' => $item->id]);
    }
}
