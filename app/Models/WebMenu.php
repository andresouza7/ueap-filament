<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'web_menu_place_id',
        'slug',
        'name',
        'description',
        'position',
        'status'
    ];

    // public function menu_place()
    // {
    //     return $this->belongsTo(WebMenuPlace::class, 'web_menu_place_id');
    // }

    public function items()
    {
        return $this->hasMany(WebMenuItem::class);
    }

    public function web_page()
    {
        return $this->hasOne(WebPage::class, 'web_menu_id');
    }

    public function web_menu_place()
    {
        return $this->belongsTo(WebMenuPlace::class, 'web_menu_place_id');
    }
}
