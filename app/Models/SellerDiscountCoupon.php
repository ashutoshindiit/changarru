<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;	

class SellerDiscountCoupon extends Model
{

    protected $table = 'seller_discount_coupons';
    
    protected $fillable = ['seller_id','coupon_code','uses_per_count','discount_type','percent','min_order_amount','maximum_discount','discount_amount','minimum_order_amount','status'];

  
    public $timestamps = false;

   
}























