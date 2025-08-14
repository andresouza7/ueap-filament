<?php

namespace App\Filament\App\Resources\Site\WebBannerResource\Pages;

use App\Actions\HandlesFileUpload;
use App\Filament\App\Resources\Site\WebBannerResource;
use App\Models\WebBanner;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateWebBanner extends CreateRecord
{
    use HandlesFileUpload;

    protected static string $resource = WebBannerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['description'] = '';
        $data['hits'] = 0;
        $data['user_created_id'] = auth()->id();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $this->storeFileWithModelId($record, $data['file'], 'web/banners');

        return $record;
    }
}
