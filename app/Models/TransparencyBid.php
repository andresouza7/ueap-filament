<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransparencyBid extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'number',
        'year',
        'type',
        'person_type',
        'location',
        'link',
        'description',
        'observation',
        'start_date',
        'end_date',
        'status',
        'user_created_id',
        'user_updated_id'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function documents()
    {
        return $this->hasMany(TransparencyBidDocument::class);
    }
}
