<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticateContract;

class People extends Model implements AuthenticateContract
{
    use HasFactory, HasApiTokens, Authenticatable;

    protected $fillable = ['name', 'email', 'password'];


    public function participants(){

        return $this->hasMany(Participant::class); 
    
    }

    public function messages(){

        return $this->hasMany(Message::class); 
    
    }

    public function conversations(){
        
        return $this->hasMany(Conversation::class);
    
    }
}
