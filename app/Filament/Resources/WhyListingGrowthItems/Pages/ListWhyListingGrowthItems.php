<?php

namespace App\Filament\Resources\WhyListingGrowthItems\Pages;

use App\Filament\Resources\WhyListingGrowthItems\WhyListingGrowthItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWhyListingGrowthItems extends ListRecords
{
    protected static string $resource = WhyListingGrowthItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
