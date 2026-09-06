<?php

namespace Database\Factories;

use App\Models\MarketingSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MarketingSetting>
 */
class MarketingSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gtm_enabled' => false,
            'ga4_enabled' => false,
            'meta_pixel_enabled' => false,
            'tiktok_pixel_enabled' => false,
        ];
    }
}
