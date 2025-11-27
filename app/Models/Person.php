<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Person extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->dontSubmitEmptyLogs();
    }

    protected $table = 'persons';

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'email',
        'cpf_cnpj',
        'birthdate',
        'phone',
        'lattes',
        'resume'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'person_id');
    }

    public function ordinances()
    {
        return $this->belongsToMany(
            Portaria::class,
            'document_ordinance_person',
            'person_id',
            'document_ordinance_id',
        );
    }
}
