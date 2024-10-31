<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'web_menu_id',
        'user_created_id',
        'web_category_id',
        'slug',
        'title',
        'description',
        'text',
        'status',
    ];

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

    public function web_menu()
    {
        return $this->belongsTo(WebMenu::class, 'web_menu_id');
    }

    public function menu_items()
    {
        return $this->hasManyThrough(WebMenuItem::class, WebMenu::class, 'id', 'web_menu_id', 'web_menu_id', 'id');
    }
}
