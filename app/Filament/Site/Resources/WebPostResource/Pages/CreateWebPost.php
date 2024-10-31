<?php

namespace App\Filament\Site\Resources\WebPostResource\Pages;

use App\Filament\Site\Resources\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWebPost extends CreateRecord
{
    protected static string $resource = WebPostResource::class;
}
