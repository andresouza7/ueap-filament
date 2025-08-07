<?php

namespace App\Filament\Transparencia\Resources\QuadroDespesaResource\Pages;

use App\Filament\Transparencia\Resources\QuadroDespesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuadroDespesa extends EditRecord
{
    protected static string $resource = QuadroDespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
