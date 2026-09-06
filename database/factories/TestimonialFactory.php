<?php

namespace Database\Factories;

use App\Models\Testimonial;
use App\Models\TestimonialSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'testimonial_section_id' => TestimonialSection::factory(),
            'feedback' => fake()->paragraph(),
            'name' => fake()->name(),
            'objective' => fake()->jobTitle(),
            'profile_path' => null,
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
        ];
    }
}
