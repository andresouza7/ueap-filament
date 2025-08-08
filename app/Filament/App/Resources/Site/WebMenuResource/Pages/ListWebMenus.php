<?php

namespace App\Filament\App\Resources\Site\WebMenuResource\Pages;

use App\Filament\App\Resources\Site\WebMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebMenus extends ListRecords
{
    protected static string $resource = WebMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
