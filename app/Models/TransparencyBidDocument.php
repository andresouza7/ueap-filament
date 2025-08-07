<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TransparencyBidDocument extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'uuid',
        'number',
        'transparency_bid_id',
        'description',
        'hits',
        'user_created_id',
        'user_updated_id'
    ];

    public function bid(): BelongsTo
    {
        return $this->belongsTo(TransparencyBid::class, 'transparency_bid_id');
    }


    public function user_created()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }
}
