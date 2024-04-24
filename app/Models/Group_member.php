<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Group_member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'group_member';
    protected $fillable = ['id','group_id','member_type','member_id'];

}
