<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecos\Pages;

use App\Filament\App\Resources\Transparencia\RegistroPrecos\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateRegistroPreco extends CreateRecord
{
    protected static string $resource = RegistroPrecoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['uuid'] = Str::uuid();
        $data['type'] = 'ata';
        $data['hits'] = 0;
        $data['status'] = 'active';
        $data['user_created_id'] = Auth::id();

        return $data;
    }

    protected function afterCreate(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_transparencia', 'create', class_basename($this->record) . ":{$this->record->id}");
    }
}
