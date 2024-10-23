<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'respondent_id',
        'category_id',
        'course_id'
    ];

    public function respondent() {
        return $this->belongsTo(Respondent::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
