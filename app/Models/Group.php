<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
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
    ];

    protected $appends = [
        'photo_url'
    ];

    public function getPhotoUrlAttribute()
    {
        return asset('img/brasao_ueap.png');
    }

    public function sub_groups()
    {
        return $this->hasMany(Group::class, 'group_parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Group::class, 'group_parent_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'group_id');
    }

    public function usersWithPermissions()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    // public function posts()
    // {
    //     return $this->hasMany(SocialPost::class, 'group_id');
    // }

    public function commissioned_role()
    {
        return $this->hasOne(CommissionedRole::class)->with('occupant');
    }

    public function document_categories()
    {
        return $this->belongsToMany(DocumentCategory::class, 'document_category_group');
    }
}
