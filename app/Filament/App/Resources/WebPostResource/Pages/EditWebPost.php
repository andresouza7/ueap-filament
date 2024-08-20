<?php

namespace App\Filament\App\Resources\WebPostResource\Pages;

use App\Filament\App\Resources\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebPost extends EditRecord
{
    protected static string $resource = WebPostResource::class;

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
