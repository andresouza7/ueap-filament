<?php

namespace App\Filament\App\Resources\Gestao\TestAtaResource\Pages;

use App\Filament\App\Resources\Gestao\TestAtaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTest extends EditRecord
{
    protected static string $resource = TestAtaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
