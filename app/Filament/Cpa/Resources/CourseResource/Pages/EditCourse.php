<?php

namespace App\Filament\Cpa\Resources\CourseResource\Pages;

use App\Filament\Cpa\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
