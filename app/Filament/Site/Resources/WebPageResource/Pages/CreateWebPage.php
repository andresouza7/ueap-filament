<?php

namespace App\Filament\Site\Resources\WebPageResource\Pages;

use App\Filament\Site\Resources\WebPageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
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
}
