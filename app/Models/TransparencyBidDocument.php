<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransparencyBidDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'number',
        'year',
        'type',
        'location',
        'link',
        'description',
        'observation',
        'start_date',
        'status',
        'user_created_id'
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
