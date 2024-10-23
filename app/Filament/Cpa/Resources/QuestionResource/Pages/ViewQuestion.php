<?php

namespace App\Filament\Cpa\Resources\QuestionResource\Pages;

use App\Filament\Cpa\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuestion extends ViewRecord
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
