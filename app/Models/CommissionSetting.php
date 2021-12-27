<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;


class CommissionSetting extends Model
{
    use HasFactory;
    
    protected $table = 'commision_settings';
    protected $fillable = ['commission_role','user_commision_type','user_commission_amount','user_commission_percentage','seller_commision_type','seller_commission_amount','seller_commission_percentage'];
}


  
    


