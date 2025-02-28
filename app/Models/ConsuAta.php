<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsuAta extends Model
{
    use HasFactory, SoftDeletes;


    protected $dates = [
        'issuance_date'
    ];

    protected $fillable = [
        'uuid',
        'title',
        'issuer',
        'issuance_date',
        'description',
        'hits',
        'user_created_id'
    ];

}
