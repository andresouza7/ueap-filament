<?php

namespace App\Filament\App\Resources\Site\PortariaConsuResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\PortariaConsuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortaria extends EditRecord
{
    protected static string $resource = PortariaConsuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
