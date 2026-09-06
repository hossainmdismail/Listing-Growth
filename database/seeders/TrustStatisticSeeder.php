<?php

namespace Database\Seeders;

use App\Models\TrustStatistic;
use Illuminate\Database\Seeder;

class TrustStatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statistics = [
            ['field_name' => 'Brands scaled', 'field_value' => '500+', 'sort_order' => 1],
            ['field_name' => 'Organic sales generated', 'field_value' => '$12M+', 'sort_order' => 2],
            ['field_name' => 'Amazon growth experience', 'field_value' => '10+ yrs', 'sort_order' => 3],
            ['field_name' => 'Average client rating', 'field_value' => '4.9/5', 'sort_order' => 4],
        ];

        foreach ($statistics as $statistic) {
            TrustStatistic::query()->updateOrCreate(
                ['field_name' => $statistic['field_name']],
                [...$statistic, 'is_active' => true],
            );
        }
    }
}
