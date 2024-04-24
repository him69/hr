<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User_assets extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_assets';
    protected $fillable = [
        'id', 'uid', 'assets_id','from','to','status','verify'
    ];
}