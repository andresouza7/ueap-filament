<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SocialPost extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'id',
        'uuid',
        'user_id',
        'group_id',
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->with('person');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
}
