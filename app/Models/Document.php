<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "document_generals";

    protected $fillable = [
        'id',
        'uuid',
        'year',
        'type',
        'title',
        'description',
        'status',
        'user_created_id'
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'user_updated_id');
    }
}
