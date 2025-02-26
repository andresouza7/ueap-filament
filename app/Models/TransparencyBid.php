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

    protected $dates = [
        'start_date',
        'end_date'
    ];

    public function documents(){
        return $this->hasMany(TransparencyBidDocument::class);
    }

}
