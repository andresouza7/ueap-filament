<?php

namespace App\Filament\App\Resources\Site\WebMenuPlaceResource\Pages;

use App\Filament\App\Resources\Site\WebMenuPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebMenuPlace extends EditRecord
{
    protected static string $resource = WebMenuPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
