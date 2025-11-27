<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ConsuResolution extends Model
{
    use HasFactory, SoftDeletes, HandlesFileUpload, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'id',
        'uuid',
        'number',
        'name',
        'description',
        'year',
        'user_created_id'
    ];

    protected $appends = [
        "file_url"
    ];

    public function getFileUrlAttribute()
    {
        $newPath = 'consu/resolutions/' . $this->id . '.pdf';
        $oldFile = $this->get_old_file;
        $oldPath = $oldFile
            ? "consu/resolutions/{$this->year}/{$oldFile->codname}.pdf"
            : null;

        if (Storage::exists($newPath)) {
            return Storage::url($newPath);
        }

        if ($oldPath && Storage::exists($oldPath)) {
            return Storage::url($oldPath);
        }

        return null;
    }

    public function get_old_file()
    {
        return $this->belongsTo(WebOldFile::class, 'old_file', 'id');
    }
}
