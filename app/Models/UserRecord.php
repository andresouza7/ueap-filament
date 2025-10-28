<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserRecord extends Model
{
    use HasFactory;

    protected $table = 'user_records';

    protected $primaryKey = 'uuid';

    protected $casts = [
        'uuid' => 'string'
    ];

    protected $fillable = [
        'uuid',
        'user_uuid',
        'ordinance',
        'ordinance_date',
        'admission_date',
        'category',
        'class_id',
        'level_id',
        'title'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
