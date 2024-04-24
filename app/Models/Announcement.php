<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Announcement extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'announcement';
    protected $fillable = [
        'id', 'by_user_type', 'by_user_ids', 'subject', 'message'
    ];
}
