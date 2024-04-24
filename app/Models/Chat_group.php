<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Chat_group extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'chat_group';
    protected $fillable = ['id','group_name'];

}
