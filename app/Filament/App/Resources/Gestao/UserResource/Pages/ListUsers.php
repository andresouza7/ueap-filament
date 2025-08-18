<?php

namespace App\Filament\App\Resources\Gestao\UserResource\Pages;

use App\Filament\App\Resources\Gestao\UserResource;
use App\Filament\Exports\UserExporter;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label('Exportar Planilha')
                ->exporter(UserExporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
