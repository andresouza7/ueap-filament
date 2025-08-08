<?php

namespace App\Filament\Transparencia\Resources\DotacaoResource\Pages;

use App\Filament\Transparencia\Resources\DotacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateDotacao extends CreateRecord
{
    protected static string $resource = DotacaoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['type'] = 'dotacao';

        return $data;
    }
}
