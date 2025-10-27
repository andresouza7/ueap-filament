<?php

namespace App\Filament\App\Resources\Site\WebPages\Pages;

use App\Filament\App\Resources\Site\WebPages\WebPageResource;
use App\Models\WebPage;
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
        $last = WebPage::withTrashed()->latest('id')->first();

        $data['id'] = $last ? $last->id + 1 : 1;
        $data['user_created_id'] = Auth::id();
        $data['uuid'] = Str::uuid();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        if ($data['file']) $record->storeFileWithModelId($data['file'], 'web/pages');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
