<?php

namespace App\Filament\App\Resources\Site\WebBanners\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\WebBanners\WebBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebBanner extends EditRecord
{
    protected static string $resource = WebBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
