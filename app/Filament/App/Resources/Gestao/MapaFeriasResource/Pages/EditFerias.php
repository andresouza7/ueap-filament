<?php

namespace App\Filament\App\Resources\Gestao\MapaFeriasResource\Pages;

use App\Filament\App\Resources\Gestao\MapaFeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFerias extends EditRecord
{
    protected static string $resource = MapaFeriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
