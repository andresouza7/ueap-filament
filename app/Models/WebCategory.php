<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class WebCategory extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'uuid',
        'web_section_id',
        'name',
        'description',
        'slug',
    ];

    // public function posts()
    // {
    //     return $this->hasMany(WebPost::class);
    // }

    // Em WebCategory.php
    public function posts()
    {
        return $this->belongsToMany(WebPost::class, 'web_category_post', 'web_category_id', 'web_post_id');
    }

    public function pages()
    {
        return $this->hasMany(WebPage::class);
    }

    public function section()
    {
        return $this->belongsTo(WebSection::class, 'web_section_id');
    }
}
