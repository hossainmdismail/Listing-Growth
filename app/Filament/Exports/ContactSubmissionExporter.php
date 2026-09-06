<?php

namespace App\Filament\Exports;

use App\Models\ContactSubmission;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Str;

class ContactSubmissionExporter extends Exporter
{
    protected static ?string $model = ContactSubmission::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('name')->formatStateUsing(self::sanitizeSpreadsheetValue(...)),
            ExportColumn::make('email')->formatStateUsing(self::sanitizeSpreadsheetValue(...)),
            ExportColumn::make('listing_url')
                ->label('Amazon Listing URL')
                ->formatStateUsing(self::sanitizeSpreadsheetValue(...)),
            ExportColumn::make('category')->formatStateUsing(self::sanitizeSpreadsheetValue(...)),
            ExportColumn::make('service')->formatStateUsing(self::sanitizeSpreadsheetValue(...)),
            ExportColumn::make('message')->formatStateUsing(self::sanitizeSpreadsheetValue(...)),
            ExportColumn::make('status')
                ->formatStateUsing(fn (?string $state): string => ContactSubmission::statusOptions()[$state] ?? (string) $state),
            ExportColumn::make('admin_notes')
                ->label('Admin Notes')
                ->formatStateUsing(self::sanitizeSpreadsheetValue(...)),
            ExportColumn::make('created_at')->label('Submitted At'),
            ExportColumn::make('updated_at')->label('Updated At'),
        ];
    }

    public function getJobConnection(): ?string
    {
        return 'sync';
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your contact submission export has completed and '.Str::of('row')->counted($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Str::of('row')->counted($failedRowsCount).' failed to export.';
        }

        return $body;
    }

    private static function sanitizeSpreadsheetValue(mixed $state): string
    {
        $value = (string) ($state ?? '');

        return Str::startsWith($value, ['=', '+', '-', '@']) ? "'{$value}" : $value;
    }
}
