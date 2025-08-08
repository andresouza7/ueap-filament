<?php

namespace App\Filament\Transparencia\Resources\DotacaoResource\Pages;

use App\Filament\Transparencia\Resources\DotacaoResource;
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
