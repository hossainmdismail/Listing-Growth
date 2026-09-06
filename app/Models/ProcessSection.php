<?php

namespace App\Models;

use Database\Factories\ProcessSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProcessSection extends Model
{
    /** @use HasFactory<ProcessSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'description',
    ];

    /** @return HasMany<ProcessItem, $this> */
    public function items(): HasMany
    {
        return $this->hasMany(ProcessItem::class);
    }

    public static function singleton(): self
    {
        return self::query()->firstOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'Our Process',
                'title' => 'Test. Rank. Sell. Repeat.',
                'description' => 'A four-step process, in order — each step feeds directly into the next.',
            ],
        );
    }
}
