<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Web extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'slug',
        'template',
        'status',
    ];

    public function sections()
    {
        return $this->hasMany(WebSection::class);
    }
    public function menu_places()
    {
        return $this->hasMany(WebMenuPlace::class);
    }
    public function banner_places()
    {
        return $this->hasMany(WebBannerPlace::class);
    }
}
