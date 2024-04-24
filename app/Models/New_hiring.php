<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class New_hiring extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'new_hiring';
    protected $fillable = [
        'id', 'name', 'email', 'mobile', 'alt_mobile', 'highest_degree', 'resume', 'aadhar_card', 'pan_card', 'old_salary_slip', 'old_experience_letter', 'salary', 'apply_for', 'status', 'progress', 'interview_date', 'joining_date'
    ];

}
