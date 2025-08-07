<?php

namespace App\Filament\Transparencia\Resources\QuadroDespesaResource\Pages;

use App\Filament\Transparencia\Resources\QuadroDespesaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateQuadroDespesa extends CreateRecord
{
    protected static string $resource = QuadroDespesaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['type'] = 'qdd';

        return $data;
    }
}
