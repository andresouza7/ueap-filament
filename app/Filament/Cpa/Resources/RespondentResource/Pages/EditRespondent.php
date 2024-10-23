<?php

namespace App\Filament\Cpa\Resources\RespondentResource\Pages;

use App\Filament\Cpa\Resources\RespondentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRespondent extends EditRecord
{
    protected static string $resource = RespondentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
