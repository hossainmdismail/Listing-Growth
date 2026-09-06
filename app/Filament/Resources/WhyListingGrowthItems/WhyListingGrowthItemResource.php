<?php

namespace App\Filament\Resources\WhyListingGrowthItems;

use App\Filament\Resources\WhyListingGrowthItems\Pages\CreateWhyListingGrowthItem;
use App\Filament\Resources\WhyListingGrowthItems\Pages\EditWhyListingGrowthItem;
use App\Filament\Resources\WhyListingGrowthItems\Pages\ListWhyListingGrowthItems;
use App\Filament\Resources\WhyListingGrowthItems\Pages\ViewWhyListingGrowthItem;
use App\Filament\Resources\WhyListingGrowthItems\Schemas\WhyListingGrowthItemForm;
use App\Filament\Resources\WhyListingGrowthItems\Schemas\WhyListingGrowthItemInfolist;
use App\Filament\Resources\WhyListingGrowthItems\Tables\WhyListingGrowthItemsTable;
use App\Models\WhyListingGrowthItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WhyListingGrowthItemResource extends Resource
{
    protected static ?string $model = WhyListingGrowthItem::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Why Section Items';

    protected static string|\UnitEnum|null $navigationGroup = 'Home Page';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'why section item';

    protected static ?string $pluralModelLabel = 'why section items';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return WhyListingGrowthItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WhyListingGrowthItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WhyListingGrowthItemsTable::configure($table);
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
            'index' => ListWhyListingGrowthItems::route('/'),
            'create' => CreateWhyListingGrowthItem::route('/create'),
            'view' => ViewWhyListingGrowthItem::route('/{record}'),
            'edit' => EditWhyListingGrowthItem::route('/{record}/edit'),
        ];
    }
}
