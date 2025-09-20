<?php

namespace App\Filament\App\Resources\Site\ConsuResolutionResource\Pages;

use App\Filament\App\Resources\Site\ConsuResolutionResource;
use App\Models\ConsuResolution;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateConsuResolution extends CreateRecord
{
    protected static string $resource = ConsuResolutionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $last = ConsuResolution::withTrashed()->latest('id')->first();

        $data['id'] = $last ? $last->id + 1 : 1;
        $data['user_created_id'] = Auth::id();
        $data['uuid'] = Str::uuid();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $record->storeFileWithModelId($data['file'], 'consu/resolutions');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
