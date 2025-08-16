<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaModel extends Model
{
    use HandlesFileUpload;

    protected string $directory = '';
    protected string $extension = '';

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute(): ?string
    {
        if (!$this->id || empty($this->directory) || empty($this->extension)) {
            return null;
        }

        $path = $this->directory . '/' . $this->id . '.' . $this->extension;

        return Storage::exists($path) ? Storage::url($path) : null;
    }

    protected static function booted(): void
    {
        static::deleting(function ($model) {
            if ($model->id && !empty($model->directory) && !empty($model->extension)) {
                $path = $model->directory . '/' . $model->id . '.' . $model->extension;
                Storage::delete($path);
            }
        });
    }
}
