<?php

namespace Database\Factories;

use App\Models\FaqItem;
use App\Models\FaqSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FaqItem>
 */
class FaqItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'faq_section_id' => FaqSection::factory(),
            'question' => fake()->sentence().'?',
            'answer' => fake()->paragraph(),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_active' => true,
            'show_on_contact_page' => false,
        ];
    }
}
