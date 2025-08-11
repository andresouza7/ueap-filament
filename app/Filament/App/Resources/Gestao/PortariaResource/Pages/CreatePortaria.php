<?php

namespace App\Filament\App\Resources\Gestao\PortariaResource\Pages;

use App\Filament\App\Resources\Gestao\PortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePortaria extends CreateRecord
{
    protected static string $resource = PortariaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (auth()->user()->hasRole('consu')) {
            $data['origin'] = 'CONSU';
        }

        return $data;
    }
}
