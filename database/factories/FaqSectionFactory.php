<?php

namespace Database\Factories;

use App\Models\FaqSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FaqSection>
 */
class FaqSectionFactory extends Factory
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
            'label' => 'FAQs',
            'title' => fake()->sentence(5),
            'description' => null,
        ];
    }
}
