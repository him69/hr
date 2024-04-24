<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Policies extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'policies';
    protected $fillable = [
        'name','content','status','user_type'
    ];
    
}