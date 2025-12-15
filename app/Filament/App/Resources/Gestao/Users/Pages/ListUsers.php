<?php

namespace App\Filament\App\Resources\Gestao\Users\Pages;

use Filament\Actions\ExportAction;
use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Gestao\Users\UserResource;
use App\Filament\Exports\UserExporter;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->label('Exportar Planilha')
                ->exporter(UserExporter::class),
            CreateAction::make(),
        ];
    }

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }
}
