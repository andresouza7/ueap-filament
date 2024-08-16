<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Builder;

class DocumentOrdinance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_ordinances';

    protected $fillable = [
        'id',
        'number',
        'description',
        'year',
        'subject',
        'origin',
        'created_at'
    ];

    protected $casts = [
        'number' => 'integer',
    ];

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'document_ordinance_person');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('description', function (Builder $builder) {
            $builder->whereNotNull('description');
        });
    }
}
