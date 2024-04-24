<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class QA_attendance extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'qa_attendance';
    protected $fillable = [
        'user_id', 'mark', 'mark_date', 'nonpause', 'login_time', 'logout_time', 'sale_made', 'customer'
    ];

}
