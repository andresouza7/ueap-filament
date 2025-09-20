<?php

namespace App\Filament\App\Resources\Site\WebBannerResource\Pages;

use App\Actions\HandlesFileUpload;
use App\Filament\App\Resources\Site\WebBannerResource;
use App\Models\WebBanner;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateWebBanner extends CreateRecord
{
    use HandlesFileUpload;

    protected static string $resource = WebBannerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $last = WebBanner::withTrashed()->latest('id')->first();

        $data['id'] = $last ? $last->id + 1 : 1;
        $data['uuid'] = Str::uuid();
        $data['description'] = '';
        $data['hits'] = 0;
        $data['user_created_id'] = Auth::id();

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $record->storeFileWithModelId($data['file'], 'web/banners');

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
