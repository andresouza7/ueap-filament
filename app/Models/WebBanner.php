<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebBanner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'web_banner_place_id',
        'name',
        'description',
        'url',
        'status',
        'hits',
        'user_created_id',
        'user_updated_id'
    ];

    protected $appends = ['image_url'];

    public function banner_place()
    {
        return $this->belongsTo(WebBannerPlace::class, 'web_banner_place_id', 'id');
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'user_created_id', 'id', 'users');
    }
    public function user_updated()
    {
        return $this->belongsTo(User::class, 'user_updated_id', 'id', 'users');
    }

    public function getImageUrlAttribute()
    {
        return file_service('web/banners', 'jpg')->getFileUrl($this->id);
    }
}
