<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Portaria extends Model
{
    use HasFactory, SoftDeletes, HandlesFileUpload;

    protected $table = 'document_ordinances';

    protected $fillable = [
        'id',
        'number',
        'description',
        'year',
        'subject',
        'origin',
        'created_at',
    ];

    protected $casts = [
        'number' => 'integer',
    ];

    protected $appends = [
        'file_url'
    ];

    public function getFileUrlAttribute()
    {
        $path = 'documents/ordinances/' . $this->id . '.pdf';

        return Storage::exists($path) ? Storage::url($path) : null;
    }

    public function persons()
    {
        return $this->belongsToMany(
            Person::class,
            'document_ordinance_person',
            'document_ordinance_id',
            'person_id'
        );
    }

    public function impediments() {
        return $this->hasMany(Impediment::class, 'document_ordinance_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('description', function (Builder $builder) {
            $builder->whereNotNull('description');
        });
    }
}
