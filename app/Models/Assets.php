<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Assets extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'assets';
    protected $fillable = [
        'id','product_code', 'asset_name', 'asset_type', 'serial_number', 'ass_spec', 'asset_owner', 'vander', 'purchase_date', 'warranty','product_img','invoice','remark','status'
    ];
    
}
