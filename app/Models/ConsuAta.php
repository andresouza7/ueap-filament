<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ConsuAta extends Model
{
    use HasFactory, SoftDeletes, HandlesFileUpload, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $dates = [
        'issuance_date'
    ];

    protected $fillable = [
        'uuid',
        'title',
        'issuer',
        'issuance_date',
        'description',
        'hits',
        'user_created_id'
    ];

    protected $casts = [
        'issuance_date' => 'date'
    ];

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute()
    {
        $path = 'documents/atas/' . $this->id . '.pdf';

        return Storage::exists($path) ? Storage::url($path) : null;
    }
}
