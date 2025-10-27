<?php

namespace App\Filament\App\Resources\Site\ConsuAtas\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\ConsuAtas\ConsuAtaResource;
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
