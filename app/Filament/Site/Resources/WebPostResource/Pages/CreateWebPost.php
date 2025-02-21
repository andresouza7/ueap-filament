<?php

namespace App\Filament\Site\Resources\WebPostResource\Pages;

use App\Filament\Site\Resources\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateWebPost extends CreateRecord
{
    protected static string $resource = WebPostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_created_id'] = Auth::user()->id;
        $data['uuid'] = Str::uuid();

        return $data;
    }
}
