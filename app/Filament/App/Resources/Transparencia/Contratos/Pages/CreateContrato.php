<?php

namespace App\Filament\App\Resources\Transparencia\Contratos\Pages;

use App\Filament\App\Resources\Transparencia\Contratos\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateContrato extends CreateRecord
{
    protected static string $resource = ContratoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['type'] = 'contrato';
        $data['status'] = 'active';
        $data['hits'] = 0;
        $data['user_created_id'] = Auth::id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
