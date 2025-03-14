<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class WebPost extends Model
{
    use HasFactory, SoftDeletes;

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
        'text_credits',
        'image_credits',
        'image_subtitle',
        'status'
    ];

    protected $appends = ['image_url'];

    public function category()
    {
        return $this->belongsTo(WebCategory::class, 'web_category_id');
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

    public function getImageUrlAttribute()
    {
        return Storage::url('web/posts/' . $this->id . '.jpg');
    }
}
