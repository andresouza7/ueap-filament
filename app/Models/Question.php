<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'title',
        'dimension_id'
    ];

    public function dimension() {
        return $this->belongsTo(Dimension::class);
    }
}
