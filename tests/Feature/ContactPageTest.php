<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use App\Models\FaqItem;
use App\Models\FaqSection;
use App\Models\GlobalSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_displays_the_form_and_only_contact_faqs(): void
    {
        GlobalSetting::factory()->create([
            'contact_email' => 'current@example.com',
            'contact_phone' => '+8801700000000',
            'address' => 'Dhaka, Bangladesh',
        ]);
        $section = FaqSection::factory()->create();
        FaqItem::factory()->for($section, 'section')->create([
            'question' => 'Home page question?',
            'show_on_contact_page' => false,
        ]);
        FaqItem::factory()->for($section, 'section')->create([
            'question' => 'Contact page question?',
            'show_on_contact_page' => true,
        ]);

        $contactResponse = $this->get(route('contact'));

        $contactResponse
            ->assertOk()
            ->assertSee("Let's get your listing to Page 1", false)
            ->assertSee('Contact page question?')
            ->assertDontSee('Home page question?')
            ->assertSee('current@example.com')
            ->assertSee('+8801700000000')
            ->assertSee('Dhaka, Bangladesh')
            ->assertDontSee('hello@listinggrowth.com')
            ->assertDontSee('+1 (000) 000-0000')
            ->assertSee('name="name"', false)
            ->assertSee('name="email"', false)
            ->assertSee('name="listing_url"', false)
            ->assertSee('name="category"', false)
            ->assertSee('name="service"', false)
            ->assertSee('name="message"', false);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Home page question?')
            ->assertDontSee('Contact page question?');
    }

    public function test_frontend_script_does_not_intercept_the_real_contact_form(): void
    {
        $script = file_get_contents(public_path('frontend/js/main.js'));

        $this->assertIsString($script);
        $this->assertStringNotContainsString("contactForm.addEventListener('submit'", $script);
        $this->assertStringNotContainsString('Contact Form Submission Demo', $script);
    }

    public function test_valid_contact_form_submission_is_stored_and_status_cannot_be_injected(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => 'Jane Cooper',
            'email' => 'jane@brand.com',
            'listing_url' => 'amazon.com/dp/B012345678',
            'category' => 'Home & Kitchen',
            'service' => 'Ranking Optimization',
            'message' => 'We want to improve our organic rank.',
            'status' => ContactSubmission::STATUS_CLOSED,
            'admin_notes' => 'This must not be accepted from the public form.',
        ]);

        $response
            ->assertRedirect(route('contact'))
            ->assertSessionHas('contact_success');
        $this->assertDatabaseHas(ContactSubmission::class, [
            'name' => 'Jane Cooper',
            'email' => 'jane@brand.com',
            'listing_url' => 'https://amazon.com/dp/B012345678',
            'category' => 'Home & Kitchen',
            'service' => 'Ranking Optimization',
            'message' => 'We want to improve our organic rank.',
            'status' => ContactSubmission::STATUS_NEW,
            'admin_notes' => null,
        ]);
    }

    public function test_contact_form_rejects_invalid_data_without_storing_it(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'listing_url' => 'javascript:alert(1)',
            'category' => 'Invented Category',
            'service' => 'Invented Service',
        ]);

        $response
            ->assertRedirect(route('contact'))
            ->assertSessionHasErrors(['name', 'email', 'listing_url', 'category', 'service']);
        $this->assertDatabaseCount(ContactSubmission::class, 0);
    }
}
