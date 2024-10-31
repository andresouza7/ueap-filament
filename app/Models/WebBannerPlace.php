<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebBannerPlace extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'uuid',
        'web_id',
        'slug',
        'name',
        'description',
    ];

    public function banners()
    {
        return $this->hasMany(WebBanner::class);
    }

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}
