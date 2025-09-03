<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'file_id','file_path', 'status', 'evaluador_id', 'evaluated_at', 'month', 'year'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function evaluador()
    {
        return $this->belongsTo(User::class, 'evaluador_id');
    }
}
