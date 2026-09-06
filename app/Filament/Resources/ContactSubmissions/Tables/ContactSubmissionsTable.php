<?php

namespace App\Filament\Resources\ContactSubmissions\Tables;

use App\Filament\Exports\ContactSubmissionExporter;
use App\Models\ContactSubmission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContactSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('category')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('service')
                    ->searchable()
                    ->limit(35)
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ContactSubmission::statusOptions()[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        ContactSubmission::STATUS_NEW => 'danger',
                        ContactSubmission::STATUS_IN_PROGRESS => 'warning',
                        ContactSubmission::STATUS_CONTACTED => 'success',
                        ContactSubmission::STATUS_CLOSED => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ContactSubmission::statusOptions()),
                SelectFilter::make('category')
                    ->options(ContactSubmission::categoryOptions()),
                SelectFilter::make('service')
                    ->options(ContactSubmission::serviceOptions()),
                Filter::make('submitted_at')
                    ->schema([
                        DatePicker::make('from')->label('Submitted from'),
                        DatePicker::make('until')->label('Submitted until'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => $query
                        ->when(
                            $data['from'] ?? null,
                            fn (Builder $query, string $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['until'] ?? null,
                            fn (Builder $query, string $date): Builder => $query->whereDate('created_at', '<=', $date),
                        )),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Download')
                    ->exporter(ContactSubmissionExporter::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->exporter(ContactSubmissionExporter::class),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
