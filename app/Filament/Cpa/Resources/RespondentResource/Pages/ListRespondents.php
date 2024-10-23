<?php

namespace App\Filament\Cpa\Resources\RespondentResource\Pages;

use App\Filament\Cpa\Resources\RespondentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRespondents extends ListRecords
{
    protected static string $resource = RespondentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
