<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HealthAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'agent_role',
        'requested_date',
        'patient_note',
        'cancellation_note',
        'status',
    ];

    protected $casts = [
        'requested_date' => 'date',
    ];

    // Automatically generate UUID when creating a new model
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    // The user who requested the appointment
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
