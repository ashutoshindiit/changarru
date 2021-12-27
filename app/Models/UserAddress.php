<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
     use HasFactory;
     protected $table    = 'user_addresses';
     protected $fillable = ['name','isd_code','isd_flag','mobile_number','pincode','city','address','user_id','use_address_as_default'];
}






