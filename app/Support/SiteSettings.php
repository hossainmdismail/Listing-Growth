<?php

namespace App\Support;

use App\Models\GlobalSetting;
use Throwable;

class SiteSettings
{
    private bool $loaded = false;

    private ?GlobalSetting $settings = null;

    public function get(): ?GlobalSetting
    {
        if ($this->loaded) {
            return $this->settings;
        }

        $this->loaded = true;

        try {
            $this->settings = GlobalSetting::query()->first();
        } catch (Throwable) {
            $this->settings = null;
        }

        return $this->settings;
    }
}
