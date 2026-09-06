<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact submission')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email')->copyable(),
                        TextEntry::make('listing_url')
                            ->label('Amazon Listing URL')
                            ->url(fn (?string $state): ?string => $state, shouldOpenInNewTab: true)
                            ->placeholder('Not provided')
                            ->columnSpanFull(),
                        TextEntry::make('category')->placeholder('Not provided'),
                        TextEntry::make('service')->placeholder('Not provided'),
                        TextEntry::make('message')
                            ->placeholder('Not provided')
                            ->columnSpanFull(),
                        TextEntry::make('status')->badge(),
                        TextEntry::make('created_at')
                            ->label('Submitted At')
                            ->dateTime(),
                        TextEntry::make('admin_notes')
                            ->label('Admin Notes')
                            ->placeholder('No admin notes')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
