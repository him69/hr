<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User_document extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user_document';
    protected $fillable = [
        'id', 'uid', 'document_name', 'document_value', 'document_image', 'doc_date','doc_verify'
    ];
}
