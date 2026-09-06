<?php

namespace App\Models;

use Database\Factories\HomeServiceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomeService extends Model
{
    /** @use HasFactory<HomeServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'icon_path',
        'title',
        'short_description',
        'button_label',
        'button_url',
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

    public function getIconUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->icon_path);
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
