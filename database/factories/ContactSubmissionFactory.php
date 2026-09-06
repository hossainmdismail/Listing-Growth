<?php

namespace Database\Factories;

use App\Models\ContactSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactSubmission>
 */
class ContactSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'listing_url' => 'https://www.amazon.com/dp/'.fake()->regexify('[A-Z0-9]{10}'),
            'category' => fake()->randomElement(array_keys(ContactSubmission::categoryOptions())),
            'service' => fake()->randomElement(array_keys(ContactSubmission::serviceOptions())),
            'message' => fake()->paragraph(),
            'status' => ContactSubmission::STATUS_NEW,
            'admin_notes' => null,
        ];
    }
}
