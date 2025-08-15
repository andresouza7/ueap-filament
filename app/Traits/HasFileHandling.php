<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

trait HasFileHandling
{
    public function addFile(string $file, string $directory): void
    {
        if (empty($file)) {
            return;
        }

        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $newFileName = "{$this->id}.{$extension}";
        $newPath = "{$directory}/{$newFileName}";

        Storage::disk('public')->move($file, $newPath);
    }

    private function getFilePath(): string
    {
        $disk = static::$fileDisk ?? 'public';
        $directory = static::$fileDirectory;
        $extension = static::$fileExtension;
        $name = "{$this->id}.{$extension}";

        return "{$directory}/{$name}";
    }

    public function hasFile(string $directory): bool
    {
        $disk = static::$fileDisk ?? 'public';
        return Storage::disk($disk)->exists($this->getFilePath());
    }

    public function getFileUrl(): ?string
    {
        if (!$this->hasFile()) {
            return null;
        }

        $disk = static::$fileDisk ?? 'public';
        return Storage::disk($disk)->url($this->getFilePath());
    }
}
