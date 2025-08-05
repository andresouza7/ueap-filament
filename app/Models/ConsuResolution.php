<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ConsuResolution extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

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

    public function get_old_file()
    {
        return $this->belongsTo(WebOldFile::class, 'old_file', 'id');
    }
}
