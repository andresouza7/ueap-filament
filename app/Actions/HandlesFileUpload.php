<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

trait HandlesFileUpload
{
    public function storeFileWithModelId(string $file, string $directory): void
    {
        if (empty($file)) {
            return;
        }

        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newFileName = $this->id . '.' . $extension;
        $newPath = $directory . '/' . $newFileName;

        Storage::disk('public')->move($file, $newPath);
    }
}
