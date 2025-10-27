<?php

namespace App\Filament\App\Resources\Social\Pontos\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Social\Pontos\PontoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPonto extends EditRecord
{
    protected static string $resource = PontoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
