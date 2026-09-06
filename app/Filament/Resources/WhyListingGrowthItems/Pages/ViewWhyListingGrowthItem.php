<?php

namespace App\Filament\Resources\WhyListingGrowthItems\Pages;

use App\Filament\Resources\WhyListingGrowthItems\WhyListingGrowthItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWhyListingGrowthItem extends ViewRecord
{
    protected static string $resource = WhyListingGrowthItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
