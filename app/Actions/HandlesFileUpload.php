<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

trait HandlesFileUpload
{
    public function storeFileWithModelId(Model $record, string $file, string $directory): void
    {
        if (empty($file) || !$record->id) {
            return;
        }

        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newFileName = $record->id . '.' . $extension;
        $newPath = $directory . '/' . $newFileName;

        Storage::disk('public')->move($file, $newPath);
    }
}
