<?php

namespace App\Filament\App\Resources\Site\WebMenus\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Site\WebMenus\WebMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebMenus extends ListRecords
{
    protected static string $resource = WebMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
