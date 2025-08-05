<?php

namespace App\Filament\Site\Resources\WebBannerResource\Pages;

use App\Filament\Site\Resources\WebBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebBanner extends EditRecord
{
    protected static string $resource = WebBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
