<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class WebBanner extends Model
{
    use HasFactory, SoftDeletes, HandlesFileUpload;

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

    public function getImageUrlAttribute()
    {
        $path = 'web/banners/' . $this->id . '.jpg';
        
        return Storage::exists($path) ? Storage::url($path) : null;
    }

    // protected static function booted()
    // {
    //     static::deleting(fn($model) => Storage::delete('web/banners/' . $model->id . '.jpg'));
    // }

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
