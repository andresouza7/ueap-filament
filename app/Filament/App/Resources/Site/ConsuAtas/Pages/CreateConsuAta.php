<?php

namespace App\Filament\App\Resources\Site\ConsuAtas\Pages;

use App\Filament\App\Resources\Site\ConsuAtas\ConsuAtaResource;
use App\Models\ConsuAta;
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
        $last = ConsuAta::withTrashed()->latest('id')->first();

        $data['id'] = $last ? $last->id + 1 : 1;
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
