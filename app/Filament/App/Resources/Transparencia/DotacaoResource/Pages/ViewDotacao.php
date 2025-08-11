<?php

namespace App\Filament\App\Resources\Transparencia\DotacaoResource\Pages;

use App\Filament\App\Resources\Transparencia\DotacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDotacao extends ViewRecord
{
    protected static string $resource = DotacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
