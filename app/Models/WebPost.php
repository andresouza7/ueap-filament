<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WebPost extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HandlesFileUpload, InteractsWithMedia;

    protected $fillable = [
        'uuid',
        'user_created_id',
        'user_updated_id',
        'web_category_id',
        'title',
        'slug',
        'resume',
        'featured',
        'text',
        'content',
        'text_credits',
        'image_credits',
        'image_subtitle',
        'status',
    ];

    protected $appends = ['image_url'];

    protected $casts = [
        'content' => 'array'
    ];

    public function getImageUrlAttribute()
    {
        $path = 'web/posts/' . $this->id . '.jpg';

        return Storage::exists($path) ? Storage::url($path) : null;
    }

    public function category()
    {
        return $this->belongsTo(WebCategory::class, 'web_category_id');
    }

    public function categories()
    {
        return $this->belongsToMany(WebCategory::class, 'web_category_post', 'web_post_id', 'web_category_id');
    }

    public function web_menu()
    {
        return $this->belongsTo(WebMenu::class, 'web_menu_id');
    }

    public function menu_items()
    {
        return $this->hasManyThrough(WebMenuItem::class, WebMenu::class, 'id', 'web_menu_id', 'web_menu_id', 'id');
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'user_created_id', 'id', 'users');
    }

    public function user_updated()
    {
        return $this->belongsTo(User::class, 'user_updated_id', 'id', 'users');
    }

    public function scopeSearch($query, $value)
    {
        $query
            ->where('title', 'ilike', "%$value%")
            ->orWhere('text', 'ilike', "%$value%");
    }
}
