<?php

namespace App\Models;

use App\Observers\EvaluationObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([EvaluationObserver::class])]
class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'respondent_id',
        'category_id',
        'course_id'
    ];

    protected $appends = [
        'progress'
    ];

    public function getProgressAttribute()
    {
        $total_questions = $this->answers->count();
        $answered_questions = $this->answers()->whereNotNull('score')->count();
        $progress = $total_questions == 0 ? 0 : ceil($answered_questions / $total_questions * 100);

        return $progress;
    }

    public function respondent()
    {
        return $this->belongsTo(Respondent::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
