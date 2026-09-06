<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GlobalSettingSeeder::class,
            MarketingSettingSeeder::class,
            SeoPageSeeder::class,
            TrustStatisticSeeder::class,
            HomeServiceSeeder::class,
            WhyListingGrowthSectionSeeder::class,
            WhyListingGrowthItemSeeder::class,
            GrowthProofSectionSeeder::class,
            GrowthProofItemSeeder::class,
            GrowthProofStatisticSeeder::class,
            CategorySectionSeeder::class,
            HomeCategorySeeder::class,
            TestimonialSectionSeeder::class,
            TestimonialSeeder::class,
            CaseStudySeeder::class,
            ProcessSectionSeeder::class,
            ProcessItemSeeder::class,
            FaqSectionSeeder::class,
            FaqItemSeeder::class,
            FinalCtaSectionSeeder::class,
        ]);

        User::query()->firstOrCreate(
            ['email' => 'test@example.com'],
            User::factory()->make(['name' => 'Test User'])->only(['name', 'password']),
        );
    }
}
