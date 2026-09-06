<?php

namespace App\Filament\Resources\SeoPages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SeoPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page_name')
                    ->label('Page')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('page_key')
                    ->label('Key')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('page_type')
                    ->label('Type')
                    ->badge()
                    ->sortable(),
                ImageColumn::make('og_image')
                    ->label('OG image')
                    ->disk('public')
                    ->square()
                    ->toggleable(),
                IconColumn::make('robots_index')
                    ->label('Index')
                    ->boolean(),
                IconColumn::make('robots_follow')
                    ->label('Follow')
                    ->boolean(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('page_type')
                    ->options([
                        'static' => 'Static',
                        'dynamic' => 'Dynamic',
                        'landing' => 'Landing page',
                        'custom' => 'Custom',
                    ]),
                TernaryFilter::make('is_active'),
                TernaryFilter::make('robots_index')->label('Allow indexing'),
                TernaryFilter::make('robots_follow')->label('Allow following links'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
