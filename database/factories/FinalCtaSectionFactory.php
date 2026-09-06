<?php

namespace Database\Factories;

use App\Models\FinalCtaSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FinalCtaSection>
 */
class FinalCtaSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'singleton_key' => 1,
            'label' => 'Ready When You Are',
            'title' => fake()->sentence(6),
            'description' => fake()->sentence(),
            'primary_button_text' => 'Get Started',
            'primary_button_url' => '/contact',
            'secondary_button_text' => 'Book a Consultation',
            'secondary_button_url' => '/contact',
        ];
    }
}
