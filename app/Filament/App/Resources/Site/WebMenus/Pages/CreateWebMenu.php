<?php

namespace App\Filament\App\Resources\Site\WebMenus\Pages;

use App\Filament\App\Resources\Site\WebMenus\WebMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateWebMenu extends CreateRecord
{
    protected static string $resource = WebMenuResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $lastMenu = static::getModel()::whereHas('menu_place', function ($query) use ($data) {
            $query->where('id', $data['web_menu_place_id']);
        })->first();

        $data['position'] = $lastMenu ? $lastMenu->position + 1 : 1;
        $data['uuid'] = Str::uuid();

        return $data;
    }

    protected function afterCreate(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_site', 'create', class_basename($this->record) . ":{$this->record->id}");
    }
}
