<?php

namespace App\Filament\App\Resources\WebPageResource\Pages;

use App\Filament\App\Resources\WebPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebPage extends EditRecord
{
    protected static string $resource = WebPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
