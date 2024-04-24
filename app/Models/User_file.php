<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User_file extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user_file';
    protected $fillable = [
        'id', 'uid', 'file_type', 'fs_type', 'file', 'file_date'
    ];
}
