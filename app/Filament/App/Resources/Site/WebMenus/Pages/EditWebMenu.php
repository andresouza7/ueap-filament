<?php

namespace App\Filament\App\Resources\Site\WebMenus\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\WebMenus\WebMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebMenu extends EditRecord
{
    protected static string $resource = WebMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
