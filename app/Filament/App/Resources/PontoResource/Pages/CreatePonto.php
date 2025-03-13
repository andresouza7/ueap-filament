<?php

namespace App\Filament\App\Resources\PontoResource\Pages;

use App\Filament\App\Resources\PontoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePonto extends CreateRecord
{
    protected static string $resource = PontoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 3;
        $data['user_id'] = Auth::id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return route('filament.app.pages.print-frequency');
    }
}
