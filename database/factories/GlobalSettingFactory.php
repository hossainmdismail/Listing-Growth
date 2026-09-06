<?php

namespace Database\Factories;

use App\Models\GlobalSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GlobalSetting>
 */
class GlobalSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_name' => fake()->company(),
            'site_tagline' => fake()->sentence(6),
            'company_description' => fake()->paragraph(),
            'contact_email' => fake()->companyEmail(),
            'contact_phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'default_meta_title' => fake()->sentence(5),
            'default_meta_description' => fake()->sentence(14),
            'canonical_base_url' => fake()->url(),
            'default_robots_meta' => 'index,follow',
        ];
    }
}
