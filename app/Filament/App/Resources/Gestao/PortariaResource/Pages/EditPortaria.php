<?php

namespace App\Filament\App\Resources\Gestao\PortariaResource\Pages;

use App\Filament\App\Resources\Gestao\PortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortaria extends EditRecord
{
    protected static string $resource = PortariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
