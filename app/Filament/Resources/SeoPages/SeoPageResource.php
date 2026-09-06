<?php

namespace App\Filament\Resources\SeoPages;

use App\Filament\Resources\SeoPages\Pages\CreateSeoPage;
use App\Filament\Resources\SeoPages\Pages\EditSeoPage;
use App\Filament\Resources\SeoPages\Pages\ListSeoPages;
use App\Filament\Resources\SeoPages\Pages\ViewSeoPage;
use App\Filament\Resources\SeoPages\Schemas\SeoPageForm;
use App\Filament\Resources\SeoPages\Schemas\SeoPageInfolist;
use App\Filament\Resources\SeoPages\Tables\SeoPagesTable;
use App\Models\SeoPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SeoPageResource extends Resource
{
    protected static ?string $model = SeoPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentMagnifyingGlass;

    protected static ?string $navigationLabel = 'SEO Pages';

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'SEO page';

    protected static ?string $pluralModelLabel = 'SEO pages';

    protected static ?string $recordTitleAttribute = 'page_name';

    public static function form(Schema $schema): Schema
    {
        return SeoPageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SeoPageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeoPagesTable::configure($table);
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
            'index' => ListSeoPages::route('/'),
            'create' => CreateSeoPage::route('/create'),
            'view' => ViewSeoPage::route('/{record}'),
            'edit' => EditSeoPage::route('/{record}/edit'),
        ];
    }
}
