<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class WebBanner extends MediaModel
{
    use HasFactory, SoftDeletes;

    protected string $directory = 'web/banners';

    protected string $extension = 'jpg';

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
}
