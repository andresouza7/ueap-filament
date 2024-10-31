<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebSection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'web_id',
        'name',
        'description',
        'slug',
    ];

    public function categories()
    {
        return $this->hasMany(WebCategory::class);
    }

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}
