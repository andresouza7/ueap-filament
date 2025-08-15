<?php

namespace App\Filament\App\Resources\Site\WebPostResource\Pages;

use App\Actions\HandlesFileUpload;
use App\Filament\App\Resources\Site\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateWebPost extends CreateRecord
{
    use HandlesFileUpload;

    protected static string $resource = WebPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_created_id'] = Auth::user()->id;
        $data['uuid'] = Str::uuid();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $this->storeFileWithModelId($record, $data['file'], 'web/posts');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
