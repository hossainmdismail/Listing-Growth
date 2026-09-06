<?php

namespace Database\Seeders;

use App\Models\GrowthProofSection;
use App\Models\GrowthProofStatistic;
use Illuminate\Database\Seeder;

class GrowthProofStatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = GrowthProofSection::singleton();

        $statistics = [
            [
                'label' => 'Avg. BSR improvement',
                'value' => '90%',
                'sort_order' => 1,
            ],
            [
                'label' => 'Years of experience',
                'value' => '10+',
                'sort_order' => 2,
            ],
            [
                'label' => 'Revenue for brand partners',
                'value' => '$1B+',
                'sort_order' => 3,
            ],
            [
                'label' => 'Avg. sales lift in 30 days',
                'value' => '30%',
                'sort_order' => 4,
            ],
        ];

        foreach ($statistics as $statistic) {
            GrowthProofStatistic::query()->updateOrCreate(
                [
                    'growth_proof_section_id' => $section->id,
                    'label' => $statistic['label'],
                ],
                [...$statistic, 'is_active' => true],
            );
        }
    }
}
