<?php

namespace App\Models;

use Database\Factories\TestimonialSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestimonialSection extends Model
{
    /** @use HasFactory<TestimonialSectionFactory> */
    use HasFactory;

    protected $fillable = [
        'label',
        'title',
        'description',
    ];

    /** @return HasMany<Testimonial, $this> */
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public static function singleton(): self
    {
        return self::query()->firstOrCreate(
            ['singleton_key' => 1],
            [
                'label' => 'Testimonials',
                'title' => 'Where Amazon success stories are born',
                'description' => null,
            ],
        );
    }
}
