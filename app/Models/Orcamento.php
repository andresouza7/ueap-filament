<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'type',
        'year',
        'month',
        'value',
        'description',
        'observation',
    ];
}
