<?php

namespace App\Filament\Transparencia\Resources\RegistroPrecoResource\Pages;

use App\Filament\Transparencia\Resources\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistroPreco extends EditRecord
{
    protected static string $resource = RegistroPrecoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
