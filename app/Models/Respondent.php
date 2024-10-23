<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'category_id'
    ];

    public function evaluation() {
        return $this->hasOne(Evaluation::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
