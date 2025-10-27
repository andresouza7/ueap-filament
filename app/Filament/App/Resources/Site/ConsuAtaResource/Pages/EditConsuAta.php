<?php

namespace App\Filament\App\Resources\Site\ConsuAtaResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\ConsuAtaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsuAta extends EditRecord
{
    protected static string $resource = ConsuAtaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
