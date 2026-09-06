<?php

namespace Database\Seeders;

use App\Models\MarketingSetting;
use Illuminate\Database\Seeder;

class MarketingSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MarketingSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'gtm_enabled' => false,
                'ga4_enabled' => false,
                'meta_pixel_enabled' => false,
                'tiktok_pixel_enabled' => false,
            ],
        );
    }
}
