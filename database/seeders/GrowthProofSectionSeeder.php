<?php

namespace Database\Seeders;

use App\Models\GrowthProofSection;
use Illuminate\Database\Seeder;

class GrowthProofSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GrowthProofSection::query()->updateOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'The Fastest Way to Grow',
                'title' => 'Built for profitable, lasting Amazon growth',
            ],
        );
    }
}
