<?php

namespace App\Filament\App\Resources\Site\WebMenuResource\Pages;

use App\Filament\App\Resources\Site\WebMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebMenu extends ViewRecord
{
    protected static string $resource = WebMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
