<?php

namespace App\Filament\Resources\TrustStatistics\Pages;

use App\Filament\Resources\TrustStatistics\TrustStatisticResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTrustStatistic extends ViewRecord
{
    protected static string $resource = TrustStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
