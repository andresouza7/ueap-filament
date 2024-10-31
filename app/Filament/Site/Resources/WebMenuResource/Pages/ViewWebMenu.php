<?php

namespace App\Filament\Site\Resources\WebMenuResource\Pages;

use App\Filament\Site\Resources\WebMenuResource;
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
