<?php

namespace App\Filament\App\Resources\Site\WebBannerResource\Pages;

use App\Filament\App\Resources\Site\WebBannerResource;
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
