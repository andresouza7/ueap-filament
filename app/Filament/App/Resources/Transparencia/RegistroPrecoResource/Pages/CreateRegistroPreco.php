<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecoResource\Pages;

use App\Filament\App\Resources\Transparencia\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateRegistroPreco extends CreateRecord
{
    protected static string $resource = RegistroPrecoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_created_id'] = auth()->id();
        $data['uuid'] = Str::uuid();
        $data['type'] = 'ata';
        $data['hits'] = 0;
        $data['status'] = 'active';

        return $data;
    }
}
