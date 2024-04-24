<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Chat extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'chat';
    protected $fillable = [
        'id', 'sender_id', 'sender_type', 'receiver_id', 'receiver_type', 'group_id', 'message_type', 'message', 'message_file'
    ];

}