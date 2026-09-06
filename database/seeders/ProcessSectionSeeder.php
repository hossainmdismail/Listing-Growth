<?php

namespace Database\Seeders;

use App\Models\ProcessSection;
use Illuminate\Database\Seeder;

class ProcessSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProcessSection::query()->updateOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'Our Process',
                'title' => 'Test. Rank. Sell. Repeat.',
                'description' => 'A four-step process, in order — each step feeds directly into the next.',
            ],
        );
    }
}
