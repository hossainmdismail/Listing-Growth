<?php

namespace App\Models;

use Database\Factories\TestimonialFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    /** @use HasFactory<TestimonialFactory> */
    use HasFactory;

    protected $fillable = [
        'testimonial_section_id',
        'feedback',
        'name',
        'objective',
        'profile_path',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::updated(function (Testimonial $testimonial): void {
            $previousProfilePath = $testimonial->getOriginal('profile_path');

            if ($testimonial->wasChanged('profile_path') && $previousProfilePath) {
                Storage::disk('public')->delete($previousProfilePath);
            }
        });

        static::deleted(function (Testimonial $testimonial): void {
            if ($testimonial->profile_path) {
                Storage::disk('public')->delete($testimonial->profile_path);
            }
        });
    }

    /** @return BelongsTo<TestimonialSection, $this> */
    public function section(): BelongsTo
    {
        return $this->belongsTo(TestimonialSection::class, 'testimonial_section_id');
    }

    public function getProfileUrlAttribute(): ?string
    {
        if (! $this->profile_path) {
            return null;
        }

        return Storage::disk('public')->url($this->profile_path);
    }

    public function getInitialsAttribute(): string
    {
        return Str::of($this->name)
            ->squish()
            ->explode(' ')
            ->filter()
            ->take(2)
            ->map(fn (string $word): string => Str::upper(Str::substr($word, 0, 1)))
            ->implode('');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
