<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Web extends Model
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
        'name',
        'description',
        'slug',
        'template',
        'status',
    ];

    public function sections()
    {
        return $this->hasMany(WebSection::class);
    }
    public function menu_places()
    {
        return $this->hasMany(WebMenuPlace::class);
    }
    public function banner_places()
    {
        return $this->hasMany(WebBannerPlace::class);
    }
}
