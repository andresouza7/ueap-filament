<?php

namespace App\Filament\App\Resources\Transparencia\Dotacaos\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Transparencia\Dotacaos\DotacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDotacao extends EditRecord
{
    protected static string $resource = DotacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
