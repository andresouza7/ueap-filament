<?php

namespace App\Filament\App\Resources\Transparencia\QuadroDespesas\Pages;

use App\Filament\App\Resources\Transparencia\QuadroDespesas\QuadroDespesaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
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

     protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $record->storeFileWithModelId($data['file'], 'documents/orcamento');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
