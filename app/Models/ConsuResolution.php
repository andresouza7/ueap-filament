<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsuResolution extends Model
{
    use HasFactory, SoftDeletes;

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
        return file_service('consu/resolutions', 'pdf')->getFileUrl($this->id);
    }

    public function get_old_file()
    {
        return $this->belongsTo(WebOldFile::class, 'old_file', 'id');
    }
}
