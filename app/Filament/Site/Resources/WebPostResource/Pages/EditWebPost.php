<?php

namespace App\Filament\Site\Resources\WebPostResource\Pages;

use App\Filament\Site\Resources\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebPost extends EditRecord
{
    protected static string $resource = WebPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
