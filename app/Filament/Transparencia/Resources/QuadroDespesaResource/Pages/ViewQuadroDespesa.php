<?php

namespace App\Filament\Transparencia\Resources\QuadroDespesaResource\Pages;

use App\Filament\Transparencia\Resources\QuadroDespesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuadroDespesa extends ViewRecord
{
    protected static string $resource = QuadroDespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
