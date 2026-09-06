<?php

namespace Tests\Feature;

use App\Filament\Resources\CaseStudies\Pages\CreateCaseStudy;
use App\Filament\Resources\CaseStudies\Pages\EditCaseStudy;
use App\Filament\Resources\CaseStudies\Pages\ListCaseStudies;
use App\Filament\Resources\CaseStudies\Pages\ViewCaseStudy;
use App\Models\CaseStudy;
use App\Models\User;
use Database\Seeders\CaseStudySeeder;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CaseStudyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_case_study_can_be_created_with_statistics_in_filament(): void
    {
        Livewire::test(CreateCaseStudy::class)
            ->fillForm([
                'label' => 'Sports & Outdoors',
                'subtitle' => '$0 to $250K in 45 days',
                'title' => 'Page 6 → Page 1',
                'short_description' => 'A managed short description.',
                'content' => '<p>Optional detailed result.</p>',
                'statistics' => [
                    ['value' => '$250K', 'label' => 'Revenue'],
                    ['value' => '240%', 'label' => 'ROI'],
                ],
                'sort_order' => 3,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors()
            ->assertRedirect();

        $caseStudy = CaseStudy::query()->where('label', 'Sports & Outdoors')->firstOrFail();

        $this->assertSame('$250K', $caseStudy->statistics[0]['value']);
        $this->assertSame('Revenue', $caseStudy->statistics[0]['label']);

        Livewire::test(ListCaseStudies::class)
            ->assertOk()
            ->assertCanSeeTableRecords([$caseStudy]);

        Livewire::test(ViewCaseStudy::class, ['record' => $caseStudy->getRouteKey()])
            ->assertOk()
            ->assertSchemaStateSet([
                'label' => 'Sports & Outdoors',
                'title' => 'Page 6 → Page 1',
            ]);
    }

    public function test_case_study_can_be_updated_and_deleted_in_filament(): void
    {
        $caseStudy = CaseStudy::factory()->create(['title' => 'Old result']);

        Livewire::test(EditCaseStudy::class, ['record' => $caseStudy->getRouteKey()])
            ->fillForm([
                'title' => 'Updated result',
                'sort_order' => 5,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(CaseStudy::class, [
            'id' => $caseStudy->id,
            'title' => 'Updated result',
            'sort_order' => 5,
        ]);

        Livewire::test(EditCaseStudy::class, ['record' => $caseStudy->getRouteKey()])
            ->callAction(DeleteAction::class)
            ->assertRedirect();

        $this->assertDatabaseMissing(CaseStudy::class, ['id' => $caseStudy->id]);
    }

    public function test_home_displays_only_active_case_studies_in_order_and_sanitizes_rich_text(): void
    {
        CaseStudy::factory()->create([
            'label' => 'Second case',
            'content' => '<p>Allowed details</p><script>alert("unsafe")</script>',
            'sort_order' => 2,
        ]);
        CaseStudy::factory()->create([
            'label' => 'First case',
            'sort_order' => 1,
        ]);
        CaseStudy::factory()->create([
            'label' => 'Hidden case',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSeeInOrder(['First case', 'Second case'])
            ->assertSee('Allowed details')
            ->assertDontSee('<script>', false)
            ->assertDontSee('Hidden case');
    }

    public function test_case_study_seeder_is_idempotent(): void
    {
        $this->seed(CaseStudySeeder::class);
        $this->seed(CaseStudySeeder::class);

        $this->assertSame(2, CaseStudy::query()->count());
    }
}
