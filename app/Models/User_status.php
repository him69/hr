<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User_status extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user_status';
    protected $fillable = [
        'id', 'uid', 'status_h', 'reason', 'blacklist'
    ];
}
