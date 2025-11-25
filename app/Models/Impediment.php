<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impediment extends Model
{

    protected $fillable = [
        'description',
        'user_id',
        'document_ordinance_id',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ordinance()
    {
        return $this->belongsTo(Portaria::class, 'document_ordinance_id');
    }
}
