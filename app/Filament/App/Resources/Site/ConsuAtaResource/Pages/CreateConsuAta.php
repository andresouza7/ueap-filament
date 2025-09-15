<?php

namespace App\Filament\App\Resources\Site\ConsuAtaResource\Pages;

use App\Filament\App\Resources\Site\ConsuAtaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateConsuAta extends CreateRecord
{
    protected static string $resource = ConsuAtaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['hits'] = 0;
        $data['user_created_id'] = Auth::id();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $record->storeFileWithModelId($data['file'], 'documents/atas');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
