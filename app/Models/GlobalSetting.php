<?php

namespace App\Models;

use Database\Factories\GlobalSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GlobalSetting extends Model
{
    /** @use HasFactory<GlobalSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_tagline',
        'company_description',
        'logo_path',
        'favicon_path',
        'contact_email',
        'contact_phone',
        'whatsapp_number',
        'address',
        'map_url',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'youtube_url',
        'footer_text',
        'copyright_text',
        'default_meta_title',
        'default_meta_description',
        'default_og_title',
        'default_og_description',
        'default_og_image_path',
        'canonical_base_url',
        'default_robots_meta',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? Storage::disk('public')->url($this->logo_path) : null;
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->favicon_path ? Storage::disk('public')->url($this->favicon_path) : null;
    }

    public function getDefaultOgImageUrlAttribute(): ?string
    {
        return $this->default_og_image_path ? Storage::disk('public')->url($this->default_og_image_path) : null;
    }
}
