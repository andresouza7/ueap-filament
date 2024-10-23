<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function dimensions() {
        return $this->hasMany(Dimension::class);
    }

    public function respondents() {
        return $this->hasMany(Respondent::class);
    }
}
