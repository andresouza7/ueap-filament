<?php

namespace App\Filament\Transparencia\Resources\DocumentResource\Pages;

use App\Filament\Transparencia\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['user_created_id'] = auth()->id();

        return $data;
    }
}
