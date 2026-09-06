<?php

namespace App\Filament\Resources\TrustStatistics;

use App\Filament\Resources\TrustStatistics\Pages\CreateTrustStatistic;
use App\Filament\Resources\TrustStatistics\Pages\EditTrustStatistic;
use App\Filament\Resources\TrustStatistics\Pages\ListTrustStatistics;
use App\Filament\Resources\TrustStatistics\Pages\ViewTrustStatistic;
use App\Filament\Resources\TrustStatistics\Schemas\TrustStatisticForm;
use App\Filament\Resources\TrustStatistics\Schemas\TrustStatisticInfolist;
use App\Filament\Resources\TrustStatistics\Tables\TrustStatisticsTable;
use App\Models\TrustStatistic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TrustStatisticResource extends Resource
{
    protected static ?string $model = TrustStatistic::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBarSquare;

    protected static ?string $navigationLabel = 'Trust Statistics';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?string $modelLabel = 'trust statistic';

    protected static ?string $pluralModelLabel = 'trust statistics';

    protected static ?string $recordTitleAttribute = 'field_name';

    public static function form(Schema $schema): Schema
    {
        return TrustStatisticForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TrustStatisticInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrustStatisticsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrustStatistics::route('/'),
            'create' => CreateTrustStatistic::route('/create'),
            'view' => ViewTrustStatistic::route('/{record}'),
            'edit' => EditTrustStatistic::route('/{record}/edit'),
        ];
    }
}
