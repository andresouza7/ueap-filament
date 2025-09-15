<?php

namespace App\Filament\App\Resources\Site\WebPageResource\Pages;

use App\Filament\App\Resources\Site\WebPageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateWebPage extends CreateRecord
{
    protected static string $resource = WebPageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_created_id'] = Auth::id();
        $data['uuid'] = Str::uuid();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $record->storeFileWithModelId($data['file'], 'web/pages');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
