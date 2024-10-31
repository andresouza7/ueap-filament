<?php

namespace App\Filament\Site\Resources\WebPostResource\Pages;

use App\Filament\Site\Resources\WebPostResource;
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
