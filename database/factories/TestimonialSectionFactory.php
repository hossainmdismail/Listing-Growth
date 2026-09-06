<?php

namespace Database\Factories;

use App\Models\TestimonialSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TestimonialSection>
 */
class TestimonialSectionFactory extends Factory
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
            'label' => 'Testimonials',
            'title' => fake()->sentence(6),
            'description' => fake()->sentence(14),
        ];
    }
}
