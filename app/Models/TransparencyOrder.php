<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransparencyOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'month',
        'year',
        'type',
        'title',
        'category',
        'description',
        'user_created_id'
    ];
}
