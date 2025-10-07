<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommissionedRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'commissioned_role_id');
    }

    public function occupant()
    {
        return $this->hasOne(User::class, 'commissioned_role_id');
    }
}
