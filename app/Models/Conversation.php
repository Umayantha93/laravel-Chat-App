<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'owner_id'
    ];

    public function people(){

        return $this->belongsTo(People::class, 'owner_id', 'id');

    }

    public function messages(){

        return $this->hasMany(Message::class);

    }


    public function participants(){

        return $this->hasMany(Participant::class);

    }
}
