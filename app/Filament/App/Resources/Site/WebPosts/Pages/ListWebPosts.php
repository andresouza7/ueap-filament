<?php

namespace App\Filament\App\Resources\Site\WebPosts\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Site\WebPosts\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebPosts extends ListRecords
{
    protected static string $resource = WebPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
