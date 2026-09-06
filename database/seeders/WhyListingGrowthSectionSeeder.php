<?php

namespace Database\Seeders;

use App\Models\WhyListingGrowthSection;
use Illuminate\Database\Seeder;

class WhyListingGrowthSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WhyListingGrowthSection::query()->updateOrCreate(
            ['singleton_key' => 1],
            [
                'section_label' => 'Why ListingGrowth',
                'title' => 'Months to rank? Not with us.',
                'description' => 'We put your product on Page 1 — and build the system that keeps it there.',
            ],
        );
    }
}
