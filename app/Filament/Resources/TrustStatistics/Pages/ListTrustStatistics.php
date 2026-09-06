<?php

namespace App\Filament\Resources\TrustStatistics\Pages;

use App\Filament\Resources\TrustStatistics\TrustStatisticResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrustStatistics extends ListRecords
{
    protected static string $resource = TrustStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
