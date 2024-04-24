<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use App\Models\Permissions;
use App\Models\User_permission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $fillable = [
        'id', 'name', 'email', 'mobile', 'alt_mobile','photo', 'gender' , 'curnt_adrs', 'prmt_adrs' , 'aadhar_card', 'aadhar_card_back', 'pan_card', 'adhar_no', 'pan_no', 'salary', 'bank_name', 'bank_account_holder_name', 'account_no', 'ifsc_code', 'user_id', 'password', 'joining_date', 'designation', 'dob', 'server_ip', 'user_type', 'lead_by','lead', 'current_week', 'late_count', 'status', 'current_month', 'leave_count', 'used_leave_count', 'rating', 'pf', 'uan_no', 'pf_no', 'pf_date', 'team_type', 'crm_emp_id', 'work_type'
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($user) {
            $currentDate = \Carbon\Carbon::now()->endOfMonth();
            User_salary::create([
                'uid' => $user->id,
                'salary' => $user->attributes['salary'],
                'from' => Carbon::now()->startOfMonth()->format('Y-m-d'),
                'to' => $currentDate->addMonths(60)->format('Y-m-d')
            ]);
        });
    }

    // protected $casts = [
    //     'joining_date' => 'date', 
    // ];

    public function salaryRelation($check_date = '') 
    {
        if($check_date == ''){
            $currentDate = now()->format('Y-m-d');
        }else{
            $currentDate = Carbon::createFromFormat('Y-m-d', $check_date);
        }
        return $this->hasOne(User_salary::class, 'uid', 'id')
                    ->whereDate('from', '<=', $currentDate)
                    ->whereDate('to', '>=', $currentDate);
    }

    public function getSalaryAttribute() 
    {
        return $this->salaryRelation ? $this->salaryRelation->salary : null;
    }
    
    public static function updateSalary($id, $newSalary, $applied_from) {
        $user = static::where('id', $id)->first();
        $startDate = Carbon::createFromFormat('Y-m', $applied_from)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $applied_from)->addMonths(60)->endOfMonth();
    
        $user->salaryRelation()->update(['to' => $startDate->copy()->subDay()]);
        User_salary::create([
            'uid' => $user->id,
            'salary' => $newSalary,
            'from' => $startDate,
            'to' => $endDate
        ]);
    }
    public function permissions()
{
    return $this->belongsToMany(Permissions::class, 'user_permission', 'uid', 'permission');
}

}