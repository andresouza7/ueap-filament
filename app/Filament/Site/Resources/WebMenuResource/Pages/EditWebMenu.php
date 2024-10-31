<?php

namespace App\Filament\Site\Resources\WebMenuResource\Pages;

use App\Filament\Site\Resources\WebMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebMenu extends EditRecord
{
    protected static string $resource = WebMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
