<?php

namespace Tests\Feature;

use App\Filament\Pages\TestimonialSectionSettings;
use App\Models\Testimonial;
use App\Models\TestimonialSection;
use App\Models\User;
use Database\Seeders\TestimonialSectionSeeder;
use Database\Seeders\TestimonialSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class TestimonialSectionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
        Filament::setCurrentPanel('admin');
    }

    public function test_section_and_testimonials_are_managed_from_one_settings_page(): void
    {
        Storage::fake('public');

        Livewire::test(TestimonialSectionSettings::class)
            ->fillForm([
                'label' => 'Client Stories',
                'title' => 'Managed testimonial section title',
                'description' => 'Managed testimonial section description.',
                'testimonials' => [
                    [
                        'feedback' => 'A testimonial with an uploaded profile.',
                        'name' => 'Jane Doe',
                        'objective' => 'Brand Founder',
                        'profile_path' => [
                            'profile-upload' => UploadedFile::fake()->image('jane.jpg', 200, 200)->size(100),
                        ],
                        'is_active' => true,
                    ],
                    [
                        'feedback' => 'A testimonial without a profile image.',
                        'name' => 'John Smith',
                        'objective' => 'Amazon Seller',
                        'profile_path' => null,
                        'is_active' => true,
                    ],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $testimonialWithProfile = Testimonial::query()->where('name', 'Jane Doe')->firstOrFail();
        $testimonialWithoutProfile = Testimonial::query()->where('name', 'John Smith')->firstOrFail();

        $this->assertSame(1, TestimonialSection::query()->count());
        $this->assertDatabaseHas(TestimonialSection::class, [
            'singleton_key' => 1,
            'label' => 'Client Stories',
            'title' => 'Managed testimonial section title',
        ]);
        Storage::disk('public')->assertExists($testimonialWithProfile->profile_path);
        $this->assertSame('JS', $testimonialWithoutProfile->initials);
    }

    public function test_home_displays_profile_or_name_initials_for_active_testimonials_in_order(): void
    {
        $section = TestimonialSection::factory()->create([
            'label' => 'Dynamic Testimonials',
            'title' => 'Dynamic testimonial title',
            'description' => 'Dynamic testimonial description.',
        ]);

        Testimonial::factory()->for($section, 'section')->create([
            'feedback' => 'Second testimonial feedback.',
            'name' => 'Photo User',
            'profile_path' => 'testimonials/profiles/photo-user.jpg',
            'sort_order' => 2,
        ]);
        Testimonial::factory()->for($section, 'section')->create([
            'feedback' => 'First testimonial feedback.',
            'name' => 'Jane Doe',
            'profile_path' => null,
            'sort_order' => 1,
        ]);
        Testimonial::factory()->for($section, 'section')->create([
            'feedback' => 'Hidden testimonial feedback.',
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response
            ->assertSee('Dynamic Testimonials')
            ->assertSee('Dynamic testimonial title')
            ->assertSee('Dynamic testimonial description.')
            ->assertSeeInOrder(['First testimonial feedback.', 'Second testimonial feedback.'])
            ->assertSee('JD')
            ->assertSee('/storage/testimonials/profiles/photo-user.jpg', false)
            ->assertDontSee('Hidden testimonial feedback.');
    }

    public function test_testimonial_content_is_escaped_on_the_homepage(): void
    {
        $section = TestimonialSection::factory()->create([
            'label' => '<script>sectionLabel()</script>',
            'title' => '<script>sectionTitle()</script>',
            'description' => '<script>sectionDescription()</script>',
        ]);
        Testimonial::factory()->for($section, 'section')->create([
            'feedback' => '<script>feedback()</script>',
            'name' => '<script>name()</script>',
            'objective' => '<script>objective()</script>',
        ]);

        $response = $this->get('/');

        $response
            ->assertSee('&lt;script&gt;', false)
            ->assertDontSee('<script>', false);
    }

    public function test_replacing_a_profile_deletes_the_previous_image(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('testimonials/profiles/old.jpg', 'old image');
        $section = TestimonialSection::factory()->create();
        $testimonial = Testimonial::factory()->for($section, 'section')->create([
            'profile_path' => 'testimonials/profiles/old.jpg',
        ]);

        $testimonial->update(['profile_path' => 'testimonials/profiles/new.jpg']);

        Storage::disk('public')->assertMissing('testimonials/profiles/old.jpg');
    }

    public function test_deleting_a_testimonial_deletes_its_profile_image(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('testimonials/profiles/profile.jpg', 'profile image');
        $section = TestimonialSection::factory()->create();
        $testimonial = Testimonial::factory()->for($section, 'section')->create([
            'profile_path' => 'testimonials/profiles/profile.jpg',
        ]);

        $testimonial->delete();

        Storage::disk('public')->assertMissing('testimonials/profiles/profile.jpg');
    }

    public function test_testimonial_seeders_are_idempotent(): void
    {
        $seeders = [
            TestimonialSectionSeeder::class,
            TestimonialSeeder::class,
        ];

        $this->seed($seeders);
        $this->seed($seeders);

        $this->assertSame(1, TestimonialSection::query()->count());
        $this->assertSame(4, Testimonial::query()->count());
    }
}
