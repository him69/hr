<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RequestLog extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'request_log';
    protected $fillable = [
        'id', 'uid', 'request_url', 'request_data'
    ];
}
