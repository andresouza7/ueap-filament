<?php

namespace App\Filament\Site\Resources\WebBannerResource\Pages;

use App\Filament\Site\Resources\WebBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateWebBanner extends CreateRecord
{
    protected static string $resource = WebBannerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['description'] = '';
        $data['hits'] = 0;
        $data['user_created_id'] = auth()->id();

        return $data;
    }
}
