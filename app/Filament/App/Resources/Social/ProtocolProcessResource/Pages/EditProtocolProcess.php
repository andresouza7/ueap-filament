<?php

namespace App\Filament\App\Resources\Social\ProtocolProcessResource\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Social\ProtocolProcessResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProtocolProcess extends EditRecord
{
    protected static string $resource = ProtocolProcessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
