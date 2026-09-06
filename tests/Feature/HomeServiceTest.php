<?php

namespace Tests\Feature;

use App\Filament\Resources\HomeServices\Pages\CreateHomeService;
use App\Filament\Resources\HomeServices\Pages\EditHomeService;
use App\Filament\Resources\HomeServices\Pages\ListHomeServices;
use App\Filament\Resources\HomeServices\Pages\ViewHomeService;
use App\Models\HomeService;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class HomeServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_home_displays_only_active_service_cards_in_order(): void
    {
        HomeService::factory()->create([
            'title' => 'Second service',
            'short_description' => 'Second service description.',
            'sort_order' => 2,
        ]);
        HomeService::factory()->create([
            'title' => 'First service',
            'short_description' => 'First service description.',
            'sort_order' => 1,
        ]);
        HomeService::factory()->create([
            'title' => 'Hidden service',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSeeInOrder(['First service', 'Second service'])
            ->assertDontSee('Hidden service');
    }

    public function test_home_service_can_be_created_viewed_and_listed_in_filament(): void
    {
        Storage::fake('public');

        Livewire::test(CreateHomeService::class)
            ->fillForm([
                'icon_path' => UploadedFile::fake()->create('ranking.svg', 10, 'image/svg+xml'),
                'title' => 'Ranking Optimization',
                'short_description' => 'A complete organic ranking service.',
                'button_label' => 'Learn more',
                'button_url' => '/services',
                'sort_order' => 1,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $service = HomeService::query()->where('title', 'Ranking Optimization')->firstOrFail();

        Storage::disk('public')->assertExists($service->icon_path);

        Livewire::test(ListHomeServices::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$service]);

        Livewire::test(ViewHomeService::class, ['record' => $service->getRouteKey()])
            ->assertOk()
            ->assertSchemaStateSet([
                'title' => 'Ranking Optimization',
                'short_description' => 'A complete organic ranking service.',
            ]);
    }

    public function test_home_service_can_be_updated_and_deleted_in_filament(): void
    {
        $service = HomeService::factory()->create([
            'title' => 'Old service title',
        ]);

        Livewire::test(EditHomeService::class, ['record' => $service->getRouteKey()])
            ->fillForm([
                'title' => 'Updated service title',
                'short_description' => 'Updated service description.',
                'sort_order' => 5,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(HomeService::class, [
            'id' => $service->id,
            'title' => 'Updated service title',
            'sort_order' => 5,
        ]);

        Livewire::test(EditHomeService::class, ['record' => $service->getRouteKey()])
            ->callAction(DeleteAction::class)
            ->assertRedirect();

        $this->assertDatabaseMissing(HomeService::class, ['id' => $service->id]);
    }
}
