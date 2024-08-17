<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// TIPOS DE OCORRENCIA:
// type 1 = ocorrencia geral cadastrada pela urh
// type 2 = afastamento de usuario cadastrado pela urh (ferias, licenca, ect)
// type 3 = ocorrencia geral cadastrada pelo usuario

class CalendarOccurrence extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'calendar_occurrences';

    protected $dates = ['start_date', 'end_date'];

    protected $fillable = [
        'user_id',
        'type',
        'start_date',
        'end_date',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
