<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use App\Models\ContactSubmission;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Submitted details')
                    ->schema([
                        TextInput::make('name')->disabled(),
                        TextInput::make('email')->disabled(),
                        TextInput::make('listing_url')
                            ->label('Amazon Listing URL')
                            ->disabled()
                            ->columnSpanFull(),
                        TextInput::make('category')->disabled(),
                        TextInput::make('service')->disabled(),
                        Textarea::make('message')
                            ->disabled()
                            ->rows(6)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Follow-up')
                    ->schema([
                        Select::make('status')
                            ->options(ContactSubmission::statusOptions())
                            ->required()
                            ->native(false),
                        Textarea::make('admin_notes')
                            ->label('Admin Notes')
                            ->rows(5)
                            ->maxLength(5000)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
