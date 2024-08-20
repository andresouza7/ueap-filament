<?php

namespace App\Filament\App\Resources\DocumentResource\Pages;

use App\Models\Document;
use App\Filament\App\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateDocument extends CreateRecord
{
    protected static string $resource = DocumentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $new_id = Document::latest('id')->first()->id + 1;

        $data['id'] = $new_id;
        $data['uuid'] = Str::uuid();
        $data['user_created_id'] = Auth::id();
        $data['user_updated_id'] = Auth::id();

        return $data;
    }
}
