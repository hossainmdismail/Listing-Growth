<?php

namespace Database\Seeders;

use App\Models\FaqSection;
use Illuminate\Database\Seeder;

class FaqSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FaqSection::query()->updateOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'FAQs',
                'title' => 'All your questions, answered',
                'description' => null,
            ],
        );
    }
}
