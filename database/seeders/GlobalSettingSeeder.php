<?php

namespace Database\Seeders;

use App\Models\GlobalSetting;
use Illuminate\Database\Seeder;

class GlobalSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlobalSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'ListingGrowth',
                'site_tagline' => 'Rank #1 on Amazon Organically',
                'company_description' => 'Organic Amazon ranking through proven SEO strategy, real shopper feedback, and targeted external traffic.',
                'footer_text' => 'Organic Amazon ranking—without paid ads—through proven SEO strategy and real shopper feedback.',
                'copyright_text' => '© '.now()->year.' ListingGrowth. All Rights Reserved.',
                'default_meta_title' => 'ListingGrowth | Rank #1 on Amazon Organically',
                'default_meta_description' => 'Grow your Amazon listing organically with proven ranking strategy, shopper feedback, and targeted external traffic.',
                'canonical_base_url' => config('app.url'),
                'default_robots_meta' => 'index,follow',
            ],
        );
    }
}
