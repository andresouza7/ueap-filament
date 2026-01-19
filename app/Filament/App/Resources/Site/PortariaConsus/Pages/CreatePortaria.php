<?php

namespace App\Filament\App\Resources\Site\PortariaConsus\Pages;

use App\Filament\App\Resources\Site\PortariaConsus\PortariaConsuResource;
use App\Models\Portaria;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreatePortaria extends CreateRecord
{
    protected static string $resource = PortariaConsuResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $last = Portaria::withTrashed()->latest('id')->first();

        $data['id'] = $last ? $last->id + 1 : 1;
        $data['origin'] = 'CONSU';

        return $data;
    }

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

    protected function afterCreate(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_site', 'create', class_basename($this->record) . ":{$this->record->id}");
    }
}
