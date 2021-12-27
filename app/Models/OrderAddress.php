<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
     use HasFactory;
     protected $table    = 'order_addresses';
     protected $fillable = ['order_id','user_id','name','isd_code','mobile_number','pincode','city','address'];
}
