<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class WebMenuItem extends Model
{
    protected $table = 'web_menu_itens';

    use HasFactory, SoftDeletes, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

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
