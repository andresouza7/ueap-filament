<?php

namespace App\Filament\App\Resources\WebPostResource\Pages;

use App\Filament\App\Resources\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebPosts extends ListRecords
{
    protected static string $resource = WebPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
