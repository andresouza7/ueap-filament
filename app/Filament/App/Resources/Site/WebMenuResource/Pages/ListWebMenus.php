<?php

namespace App\Filament\App\Resources\Site\WebMenuResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Site\WebMenuResource;
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
