<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

trait HandlesFileUpload
{
    public function storeFileWithModelId(Model $record, string $file, string $destination): void
    {
        if (empty($file)) {
            return;
        }

        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newFileName = $record->id . '.' . $extension;
        $newPath = $destination . '/' . $newFileName;

        Storage::disk('public')->move($file, $newPath);
    }
}
