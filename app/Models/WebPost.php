<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WebPost extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, HandlesFileUpload, LogsActivity, InteractsWithMedia;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logExcept(['hits'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

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
        'type'
    ];

    protected $appends = ['image_url', 'has_image'];

    protected $casts = [
        'content' => 'array'
    ];

    public function getHasImageAttribute()
    {
        if (is_array($this->content)) {
            foreach ($this->content as $block) {
                if (
                    ($block['type'] ?? null) === 'image' &&
                    !empty($block['data']['path']) &&
                    is_array($block['data']['path'])
                ) {
                    $path = $block['data']['path'][0] ?? null;

                    if ($path) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function getImageUrlAttribute()
    {
        if (is_array($this->content)) {
            foreach ($this->content as $block) {
                if (
                    ($block['type'] ?? null) === 'image' &&
                    !empty($block['data']['path']) &&
                    is_array($block['data']['path'])
                ) {
                    $path = $block['data']['path'][0] ?? null;

                    if ($path) {
                        return Storage::url($path);
                    }
                }
            }
        }

        return asset('img/site/default-thumbnail.jpg');
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

    public function scopeOnlyWithImage($query)
    {
        return $query->where('content', 'ilike', '%"type":"image"%');
    }
}
