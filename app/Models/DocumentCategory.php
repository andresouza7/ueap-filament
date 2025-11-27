<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DocumentCategory extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->dontSubmitEmptyLogs();
    }

    protected $table = 'document_categories';

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'status',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'type', 'slug');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'document_category_group');
    }
}
