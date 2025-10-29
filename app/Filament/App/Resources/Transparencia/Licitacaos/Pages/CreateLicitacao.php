<?php

namespace App\Filament\App\Resources\Transparencia\Licitacaos\Pages;

use App\Filament\App\Resources\Transparencia\Licitacaos\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateLicitacao extends CreateRecord
{
    protected static string $resource = LicitacaoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['type'] = 'licitacao';
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
