<?php

namespace App\Models;

use Database\Factories\FaqSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FaqSection extends Model
{
    /** @use HasFactory<FaqSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'description',
    ];

    /** @return HasMany<FaqItem, $this> */
    public function items(): HasMany
    {
        return $this->hasMany(FaqItem::class);
    }

    public static function singleton(): self
    {
        return self::query()->firstOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'FAQs',
                'title' => 'All your questions, answered',
                'description' => null,
            ],
        );
    }
}
