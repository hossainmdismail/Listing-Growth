<?php

namespace App\Models;

use Database\Factories\CategorySectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategorySection extends Model
{
    /** @use HasFactory<CategorySectionFactory> */
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'description',
    ];

    /** @return HasMany<HomeCategory, $this> */
    public function categories(): HasMany
    {
        return $this->hasMany(HomeCategory::class);
    }

    public static function singleton(): self
    {
        return self::query()->firstOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'Categories',
                'title' => 'Real results across every major category',
                'description' => 'From home goods to electronics, the ranking strategy adapts to your niche.',
            ],
        );
    }
}
