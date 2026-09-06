<?php

namespace App\Filament\Resources\SeoPages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SeoPageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page')
                    ->schema([
                        TextEntry::make('page_name'),
                        TextEntry::make('page_key')->copyable(),
                        TextEntry::make('page_type')->badge(),
                        IconEntry::make('is_active')->boolean(),
                    ])
                    ->columns(2),
                Section::make('Search and social metadata')
                    ->schema([
                        TextEntry::make('meta_title'),
                        TextEntry::make('meta_description')->columnSpanFull(),
                        TextEntry::make('canonical_url')->url(fn (string $state): string => $state)->columnSpanFull(),
                        TextEntry::make('og_title')->label('Open Graph title'),
                        TextEntry::make('og_description')->label('Open Graph description')->columnSpanFull(),
                        ImageEntry::make('og_image')->disk('public')->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Crawler and schema settings')
                    ->schema([
                        IconEntry::make('robots_index')->label('Allow indexing')->boolean(),
                        IconEntry::make('robots_follow')->label('Allow following links')->boolean(),
                        TextEntry::make('schema_json')
                            ->label('JSON-LD schema')
                            ->formatStateUsing(fn (mixed $state): ?string => blank($state)
                                ? null
                                : json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
