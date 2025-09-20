<?php

namespace App\Filament\App\Resources\Gestao\TestPortariaResource\Pages;

use App\Filament\App\Resources\Gestao\TestPortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTest extends EditRecord
{
    protected static string $resource = TestPortariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
