<?php

namespace App\Filament\Resources\WebPostResource\Pages;

use App\Filament\Resources\WebPostResource;
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
