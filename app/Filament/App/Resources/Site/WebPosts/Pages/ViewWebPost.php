<?php

namespace App\Filament\App\Resources\Site\WebPosts\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Site\WebPosts\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebPost extends ViewRecord
{
    protected static string $resource = WebPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
