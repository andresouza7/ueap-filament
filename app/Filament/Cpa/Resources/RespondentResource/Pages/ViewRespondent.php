<?php

namespace App\Filament\Cpa\Resources\RespondentResource\Pages;

use App\Filament\Cpa\Resources\RespondentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRespondent extends ViewRecord
{
    protected static string $resource = RespondentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
