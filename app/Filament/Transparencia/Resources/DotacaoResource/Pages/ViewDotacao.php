<?php

namespace App\Filament\Transparencia\Resources\DotacaoResource\Pages;

use App\Filament\Transparencia\Resources\DotacaoResource;
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
