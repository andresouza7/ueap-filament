<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $casts = [
        'metadata' => 'array',
    ];

    protected $fillable = [
        'uuid',
        'type',
        'name',
        'description',
        'year',
        'status',
        'metadata',
        'user_created_id',
        'user_updated_id',
    ];
}
