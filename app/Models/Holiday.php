<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Holiday extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'holiday';
    protected $fillable = [
        'id', 'user_type', 'hdate', 'description', 'created_at', 'updated_at'
    ];

}