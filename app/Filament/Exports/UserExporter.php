<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('person.name')->label('Nome'),
            ExportColumn::make('person.cpf_cnpj')->label('CPF/CNPJ'),
            ExportColumn::make('person.birthdate')->label('Data Nascimento'),
            ExportColumn::make('enrollment')->label('Matrícula'),
            ExportColumn::make('effective_role.description')->label('Cargo Efetivo'),
            ExportColumn::make('commissioned_role.description')->label('Cargo Comissionado'),
            ExportColumn::make('group.description')->label('Lotação'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
