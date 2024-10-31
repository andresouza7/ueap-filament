<?php

namespace App\Filament\Site\Resources\WebMenuPlaceResource\Pages;

use App\Filament\Site\Resources\WebMenuPlaceResource;
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
