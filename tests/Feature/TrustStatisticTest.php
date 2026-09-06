<?php

namespace Tests\Feature;

use App\Filament\Resources\TrustStatistics\Pages\CreateTrustStatistic;
use App\Filament\Resources\TrustStatistics\Pages\EditTrustStatistic;
use App\Filament\Resources\TrustStatistics\Pages\ListTrustStatistics;
use App\Filament\Resources\TrustStatistics\Pages\ViewTrustStatistic;
use App\Models\TrustStatistic;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TrustStatisticTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_home_displays_only_active_statistics_in_order_without_changing_heading(): void
    {
        TrustStatistic::factory()->create([
            'field_name' => 'Second statistic',
            'field_value' => '200+',
            'sort_order' => 2,
        ]);
        TrustStatistic::factory()->create([
            'field_name' => 'First statistic',
            'field_value' => '100+',
            'sort_order' => 1,
        ]);
        TrustStatistic::factory()->create([
            'field_name' => 'Hidden statistic',
            'field_value' => '999+',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Trusted by Amazon sellers across 30+ categories')
            ->assertSeeInOrder(['100+', 'First statistic', '200+', 'Second statistic'])
            ->assertDontSee('Hidden statistic');
    }

    public function test_trust_statistic_can_be_created_viewed_and_listed_in_filament(): void
    {
        Livewire::test(CreateTrustStatistic::class)
            ->fillForm([
                'field_name' => 'Brands scaled',
                'field_value' => '500+',
                'sort_order' => 1,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $statistic = TrustStatistic::query()->where('field_name', 'Brands scaled')->firstOrFail();

        Livewire::test(ListTrustStatistics::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$statistic]);

        Livewire::test(ViewTrustStatistic::class, ['record' => $statistic->getRouteKey()])
            ->assertOk()
            ->assertSchemaStateSet([
                'field_name' => 'Brands scaled',
                'field_value' => '500+',
            ]);
    }

    public function test_trust_statistic_can_be_updated_and_deleted_in_filament(): void
    {
        $statistic = TrustStatistic::factory()->create([
            'field_name' => 'Brands scaled',
            'field_value' => '500+',
        ]);

        Livewire::test(EditTrustStatistic::class, ['record' => $statistic->getRouteKey()])
            ->fillForm([
                'field_name' => 'Brands managed',
                'field_value' => '750+',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(TrustStatistic::class, [
            'id' => $statistic->id,
            'field_name' => 'Brands managed',
            'field_value' => '750+',
        ]);

        Livewire::test(EditTrustStatistic::class, ['record' => $statistic->getRouteKey()])
            ->callAction(DeleteAction::class)
            ->assertRedirect();

        $this->assertDatabaseMissing(TrustStatistic::class, ['id' => $statistic->id]);
    }
}
