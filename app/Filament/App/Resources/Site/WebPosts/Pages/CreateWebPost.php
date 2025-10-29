<?php

namespace App\Filament\App\Resources\Site\WebPosts\Pages;

use App\Actions\HandlesFileUpload;
use App\Filament\App\Resources\Site\WebPosts\WebPostResource;
use App\Models\WebPost;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateWebPost extends CreateRecord
{
    protected static string $resource = WebPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $last = WebPost::withTrashed()->latest('id')->first();

        $data['id'] = $last ? $last->id + 1 : 1;
        $data['user_created_id'] = Auth::user()->id;
        $data['uuid'] = Str::uuid();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        if ($data['file']) $record->storeFileWithModelId($data['file'], 'web/posts');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
