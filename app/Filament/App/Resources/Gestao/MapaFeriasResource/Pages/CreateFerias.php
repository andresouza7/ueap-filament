<?php

namespace App\Filament\App\Resources\Gestao\MapaFeriasResource\Pages;

use App\Filament\App\Resources\Gestao\MapaFeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFerias extends CreateRecord
{
    protected static string $resource = MapaFeriasResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // type 2 = mapa de ferias e afastamentos
        $data['type'] = 2;

        return $data;
    }
}
