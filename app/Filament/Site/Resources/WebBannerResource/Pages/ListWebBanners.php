<?php

namespace App\Filament\Site\Resources\WebBannerResource\Pages;

use App\Filament\Site\Resources\WebBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebBanners extends ListRecords
{
    protected static string $resource = WebBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
