<?php

namespace Tests\Feature;

use App\Filament\Resources\ContactSubmissions\Pages\EditContactSubmission;
use App\Filament\Resources\ContactSubmissions\Pages\ListContactSubmissions;
use App\Filament\Resources\ContactSubmissions\Pages\ViewContactSubmission;
use App\Models\ContactSubmission;
use App\Models\User;
use Filament\Actions\Testing\TestAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ContactSubmissionResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_admin_can_list_filter_view_and_download_contact_submissions(): void
    {
        $newSubmission = ContactSubmission::factory()->create([
            'name' => 'New Lead',
            'category' => 'Electronics',
            'service' => 'Ranking Optimization',
            'status' => ContactSubmission::STATUS_NEW,
            'created_at' => now(),
        ]);
        $closedSubmission = ContactSubmission::factory()->create([
            'name' => 'Closed Lead',
            'category' => 'Home & Kitchen',
            'service' => 'Pre-Launch Lab',
            'status' => ContactSubmission::STATUS_CLOSED,
            'created_at' => now()->subMonths(2),
        ]);

        Livewire::test(ListContactSubmissions::class)
            ->assertCanSeeTableRecords([$newSubmission, $closedSubmission])
            ->assertTableFilterExists('status')
            ->assertTableFilterExists('category')
            ->assertTableFilterExists('service')
            ->assertTableFilterExists('submitted_at')
            ->assertActionExists(TestAction::make('export')->table())
            ->filterTable('status', ContactSubmission::STATUS_NEW)
            ->assertCanSeeTableRecords([$newSubmission])
            ->assertCanNotSeeTableRecords([$closedSubmission]);

        Livewire::test(ListContactSubmissions::class)
            ->filterTable('category', 'Electronics')
            ->filterTable('service', 'Ranking Optimization')
            ->filterTable('submitted_at', ['from' => now()->subWeek()->toDateString()])
            ->assertCanSeeTableRecords([$newSubmission])
            ->assertCanNotSeeTableRecords([$closedSubmission]);

        Livewire::test(ViewContactSubmission::class, ['record' => $newSubmission->getRouteKey()])
            ->assertOk()
            ->assertSchemaStateSet([
                'name' => 'New Lead',
                'status' => ContactSubmission::STATUS_NEW,
            ]);
    }

    public function test_admin_can_update_follow_up_status_and_notes(): void
    {
        $submission = ContactSubmission::factory()->create();

        Livewire::test(EditContactSubmission::class, ['record' => $submission->getRouteKey()])
            ->fillForm([
                'status' => ContactSubmission::STATUS_CONTACTED,
                'admin_notes' => 'Followed up by email.',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(ContactSubmission::class, [
            'id' => $submission->id,
            'status' => ContactSubmission::STATUS_CONTACTED,
            'admin_notes' => 'Followed up by email.',
        ]);
    }
}
