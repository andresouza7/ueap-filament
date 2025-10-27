<?php

namespace App\Filament\App\Resources\Site\WebPostResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebPost extends EditRecord
{
    protected static string $resource = WebPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
