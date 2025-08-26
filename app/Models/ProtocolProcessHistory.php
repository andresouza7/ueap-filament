<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProtocolProcessHistory extends Model
{
    use HasFactory, SoftDeletes;


    public function group_sent(){
        return $this->belongsTo(Group::class, 'group_sent_id');
    }

    public function group_received(){
        return $this->belongsTo(Group::class, 'group_received_id');
    }


    public function user_sent(){
        return $this->belongsTo(User::class, 'user_sent_id');
    }

    public function user_received(){
        return $this->belongsTo(User::class, 'user_received_id');
    }
}
