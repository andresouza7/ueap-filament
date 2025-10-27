<?php

namespace App\Filament\App\Resources\Gestao\Portarias\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Gestao\Portarias\PortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortaria extends EditRecord
{
    protected static string $resource = PortariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
