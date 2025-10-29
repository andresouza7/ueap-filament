<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecos\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\RegistroPrecos\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRegistroPreco extends ViewRecord
{
    protected static string $resource = RegistroPrecoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
