<?php

namespace App\Models;

use Database\Factories\GrowthProofSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GrowthProofSection extends Model
{
    /** @use HasFactory<GrowthProofSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
    ];

    /** @return HasMany<GrowthProofItem, $this> */
    public function items(): HasMany
    {
        return $this->hasMany(GrowthProofItem::class);
    }

    /** @return HasMany<GrowthProofStatistic, $this> */
    public function statistics(): HasMany
    {
        return $this->hasMany(GrowthProofStatistic::class);
    }

    public static function singleton(): self
    {
        return self::query()->firstOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'The Fastest Way to Grow',
                'title' => 'Built for profitable, lasting Amazon growth',
            ],
        );
    }
}
