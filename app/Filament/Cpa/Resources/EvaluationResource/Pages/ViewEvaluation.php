<?php

namespace App\Filament\Cpa\Resources\EvaluationResource\Pages;

use App\Filament\Cpa\Resources\EvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEvaluation extends ViewRecord
{
    protected static string $resource = EvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
