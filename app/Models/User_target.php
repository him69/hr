<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User_target extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user_target';
    protected $fillable = [
        'id', 'server_type', 'target', 'from', 'to'
    ];
}
