<?php

namespace Database\Seeders;

use App\Models\CategorySection;
use Illuminate\Database\Seeder;

class CategorySectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategorySection::query()->updateOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'Categories',
                'title' => 'Real results across every major category',
                'description' => 'From home goods to electronics, the ranking strategy adapts to your niche.',
            ],
        );
    }
}
