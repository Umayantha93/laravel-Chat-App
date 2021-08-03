<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id', 'conversation_id'
    ];

    public function people(){
        return $this->belongsTo(People::class, 'person_id', 'id');
    }

    public function conversations(){
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }
}
