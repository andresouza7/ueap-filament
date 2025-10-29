<?php

namespace App\Filament\App\Resources\Site\Documents\Pages;

use App\Actions\HandlesFileUpload;
use App\Filament\App\Resources\Site\Documents\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateDocument extends CreateRecord
{
    use HandlesFileUpload;

    protected static string $resource = DocumentResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::create($data);

        $this->storeFileWithModelId($record, $data['file'], 'documents/general');

        return $record;
    }
}
