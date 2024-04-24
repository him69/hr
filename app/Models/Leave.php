<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Leave extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'leave_application';
    protected $fillable = [
        'user_id', 'leave_from', 'leave_to', 'leave_type', 'document', 'reason', 'approved'
    ];

}
