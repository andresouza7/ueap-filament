<?php

namespace App\Filament\Rh\Resources\FeriasResource\Pages;

use App\Filament\Rh\Resources\FeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFerias extends CreateRecord
{
    protected static string $resource = FeriasResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // type 2 = mapa de ferias e afastamentos
        $data['type'] = 2;

        return $data;
    }
}
