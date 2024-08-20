<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebMenuPlace extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'web_id',
        'slug',
        'name',
        'description',
    ];

    public function menus()
    {
        return $this->hasMany(WebMenu::class);
    }

    // public function web()
    // {
    //     return $this->belongsTo(Web::class);
    // }
}
