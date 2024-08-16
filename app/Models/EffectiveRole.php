<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EffectiveRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'description',
    ];

    public function users(){
        return $this->hasMany(User::class, 'effective_role_id');
    }
}
