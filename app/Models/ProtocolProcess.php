<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProtocolProcess extends Model
{
    use HasFactory, SoftDeletes;



    public function person(){
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function subject(){
        return $this->belongsTo(ProtocolSubject::class, 'subject_id');
    }

    public function group_sent(){
        return $this->belongsTo(Group::class, 'group_sent_id');
    }

    public function group_received(){
        return $this->belongsTo(Group::class, 'group_received_id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(ProtocolProcessHistory::class, 'protocol_process_id');
    }

}
