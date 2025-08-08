<?php

namespace App\Filament\Transparencia\Resources\RegistroPrecoResource\Pages;

use App\Filament\Transparencia\Resources\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRegistroPreco extends ViewRecord
{
    protected static string $resource = RegistroPrecoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
