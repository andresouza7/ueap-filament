<?php

namespace App\Filament\App\Resources\Gestao\PortariaResource\Pages;

use App\Actions\HandlesFileUpload;
use App\Filament\App\Resources\Gestao\PortariaResource;
use App\Models\Portaria;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePortaria extends CreateRecord
{
    protected static string $resource = PortariaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $last = Portaria::withTrashed()->latest('id')->first();

        $data['id'] = $last ? $last->id + 1 : 1;

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        if ($data['file']) $record->storeFileWithModelId($data['file'], 'documents/ordinances');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
