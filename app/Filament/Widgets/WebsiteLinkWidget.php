<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WebsiteLinkWidget extends Widget
{
    protected static ?int $sort = -4;

    protected static bool $isLazy = false;

    protected string $view = 'filament.widgets.website-link-widget';

    /** @return array<string, string> */
    protected function getViewData(): array
    {
        return [
            'siteUrl' => route('home'),
        ];
    }
}
