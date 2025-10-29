<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebMenuItem extends Model
{
    protected $table = 'web_menu_itens';

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'web_menu_id',
        'url',
        'name',
        'description',
        'position',
        'status'
    ];

    public function menu()
    {
        return $this->belongsTo(WebMenu::class, 'web_menu_id');
    }

    public function parent()
    {
        return $this->belongsTo(WebMenuItem::class, 'menu_parent_id');
    }

    public function sub_itens()
    {
        return $this->hasMany(WebMenuItem::class, 'menu_parent_id');
    }
}
