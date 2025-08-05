<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Document extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

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

    // generates file thumbnail on the fly
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
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
