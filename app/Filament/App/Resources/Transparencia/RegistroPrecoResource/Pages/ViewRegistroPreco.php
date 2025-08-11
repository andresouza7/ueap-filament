<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecoResource\Pages;

use App\Filament\App\Resources\Transparencia\RegistroPrecoResource;
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
