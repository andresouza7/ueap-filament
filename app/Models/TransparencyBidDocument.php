<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TransparencyBidDocument extends Model
{
    use HasFactory, SoftDeletes, HandlesFileUpload;

    protected $fillable = [
        // 'uuid',
        // 'number',
        // 'year',
        // 'type',
        // 'location',
        // 'link',
        // 'description',
        // 'observation',
        // 'start_date',
        // 'status',
        // 'user_created_id',

        'uuid',
        'number',
        'transparency_bid_id',
        'description',
        'hits',
        'user_created_id',
        'user_updated_id'
    ];

    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        $path = 'documents/bids/' . $this->id . '.pdf';
        
        return Storage::exists($path) ? Storage::url($path) : null;
    }

    public function bid(): BelongsTo
    {
        return $this->belongsTo(TransparencyBid::class, 'transparency_bid_id');
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }
}
