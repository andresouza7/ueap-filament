<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecoResource\Pages;

use App\Filament\App\Resources\Transparencia\RegistroPrecoResource;
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
