<?php

namespace App\Filament\App\Resources\Gestao\PortariaResource\Pages;

use App\Actions\HandlesFileUpload;
use App\Filament\App\Resources\Gestao\PortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePortaria extends CreateRecord
{
    protected static string $resource = PortariaResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $record->storeFileWithModelId($data['file'], 'documents/ordinances');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
