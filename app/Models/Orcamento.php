<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Orcamento extends Model
{
    use HasFactory, HandlesFileUpload, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'uuid',
        'type',
        'year',
        'month',
        'value',
        'description',
        'observation',
    ];

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute()
    {
        $path = 'documents/orcamento/' . $this->id . '.pdf';

        return Storage::exists($path) ? Storage::url($path) : null;
    }
}
