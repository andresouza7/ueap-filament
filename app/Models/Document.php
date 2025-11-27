<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Enums\Fit;

class Document extends Model
{
    use HasFactory, SoftDeletes, HandlesFileUpload, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $table = "document_generals";

    protected $fillable = [
        'id',
        'uuid',
        'year',
        'type',
        'title',
        'description',
        'status',
        'metadata',
        'old_id',
        'user_created_id',
        'user_updated_id'
    ];

    protected $casts = [
        'metadata' => 'array', // or 'json'
    ];

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute()
    {
        $path = 'documents/general/' . $this->id . '.pdf';

        return Storage::exists($path) ? Storage::url($path) : null;
    }

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'type', 'slug');
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function user_updated()
    {
        return $this->belongsTo(User::class, 'user_updated_id');
    }
}
