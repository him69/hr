<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Wfh extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'wfh';
    protected $fillable = [
        'id', 'uid', 'from', 'to', 'reason', 'status'
    ];

}