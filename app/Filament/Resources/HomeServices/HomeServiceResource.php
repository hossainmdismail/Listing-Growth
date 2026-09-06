<?php

namespace App\Filament\Resources\HomeServices;

use App\Filament\Resources\HomeServices\Pages\CreateHomeService;
use App\Filament\Resources\HomeServices\Pages\EditHomeService;
use App\Filament\Resources\HomeServices\Pages\ListHomeServices;
use App\Filament\Resources\HomeServices\Pages\ViewHomeService;
use App\Filament\Resources\HomeServices\Schemas\HomeServiceForm;
use App\Filament\Resources\HomeServices\Schemas\HomeServiceInfolist;
use App\Filament\Resources\HomeServices\Tables\HomeServicesTable;
use App\Models\HomeService;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeServiceResource extends Resource
{
    protected static ?string $model = HomeService::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $navigationLabel = 'Home Services';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?string $modelLabel = 'home service';

    protected static ?string $pluralModelLabel = 'home services';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return HomeServiceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HomeServiceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeServicesTable::configure($table);
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
            'index' => ListHomeServices::route('/'),
            'create' => CreateHomeService::route('/create'),
            'view' => ViewHomeService::route('/{record}'),
            'edit' => EditHomeService::route('/{record}/edit'),
        ];
    }
}
