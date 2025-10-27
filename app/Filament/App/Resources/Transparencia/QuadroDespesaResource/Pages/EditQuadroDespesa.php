<?php

namespace App\Filament\App\Resources\Transparencia\QuadroDespesaResource\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Transparencia\QuadroDespesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuadroDespesa extends EditRecord
{
    protected static string $resource = QuadroDespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
