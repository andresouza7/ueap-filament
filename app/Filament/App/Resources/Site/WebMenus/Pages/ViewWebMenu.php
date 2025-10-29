<?php

namespace App\Filament\App\Resources\Site\WebMenus\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Site\WebMenus\WebMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebMenu extends ViewRecord
{
    protected static string $resource = WebMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
