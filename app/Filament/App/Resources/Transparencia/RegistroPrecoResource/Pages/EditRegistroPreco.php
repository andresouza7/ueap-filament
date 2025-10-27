<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecoResource\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Transparencia\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistroPreco extends EditRecord
{
    protected static string $resource = RegistroPrecoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
