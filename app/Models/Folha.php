<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folha extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'original_name',
        'drive_file_id',
        'drive_web_view_link',
        'drive_web_content_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
