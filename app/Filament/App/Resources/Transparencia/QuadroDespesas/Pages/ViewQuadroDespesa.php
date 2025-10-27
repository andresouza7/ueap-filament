<?php

namespace App\Filament\App\Resources\Transparencia\QuadroDespesas\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\QuadroDespesas\QuadroDespesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuadroDespesa extends ViewRecord
{
    protected static string $resource = QuadroDespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
