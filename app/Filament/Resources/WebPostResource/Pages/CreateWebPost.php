<?php

namespace App\Filament\Resources\WebPostResource\Pages;

use App\Filament\Resources\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWebPost extends CreateRecord
{
    protected static string $resource = WebPostResource::class;
}
