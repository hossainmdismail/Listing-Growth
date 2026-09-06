<?php

namespace App\Filament\Resources\CaseStudies\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CaseStudyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Case study')
                    ->schema([
                        TextEntry::make('label'),
                        TextEntry::make('subtitle'),
                        TextEntry::make('title'),
                        TextEntry::make('short_description')->columnSpanFull(),
                        TextEntry::make('content')->html()->columnSpanFull(),
                        TextEntry::make('sort_order')->label('Sort Order'),
                        IconEntry::make('is_active')->label('Active')->boolean(),
                    ])
                    ->columns(2),
                Section::make('Statistics')
                    ->schema([
                        RepeatableEntry::make('statistics')
                            ->hiddenLabel()
                            ->schema([
                                TextEntry::make('value'),
                                TextEntry::make('label'),
                            ])
                            ->columns(2)
                            ->grid(3),
                    ]),
            ]);
    }
}
