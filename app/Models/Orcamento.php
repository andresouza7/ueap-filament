<?php

namespace App\Models;

use App\Actions\HandlesFileUpload;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Orcamento extends Model
{
    use HasFactory, HandlesFileUpload;

    protected $fillable = [
        'uuid',
        'type',
        'year',
        'month',
        'value',
        'description',
        'observation',
    ];

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute()
    {
        $path = 'documents/orcamento/' . $this->id . '.pdf';

        return Storage::exists($path) ? Storage::url($path) : null;
    }
}
