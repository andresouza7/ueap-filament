<?php

namespace App\Filament\App\Resources\Site\WebPosts\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\WebPosts\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

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

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        try {
            //code...
            $record->update($data);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $record;
    }
}
