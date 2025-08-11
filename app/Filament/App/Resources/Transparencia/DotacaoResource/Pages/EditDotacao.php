<?php

namespace App\Filament\App\Resources\Transparencia\DotacaoResource\Pages;

use App\Filament\App\Resources\Transparencia\DotacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDotacao extends EditRecord
{
    protected static string $resource = DotacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
