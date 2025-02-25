<?php

namespace App\Filament\Transparencia\Resources\DocumentResource\Pages;

use App\Filament\Transparencia\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeUpdate(array $data): array
    {
        $data['user_updated_id'] = auth()->id();

        return $data;
    }
}
