<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ordersDetail;
use App\Models\OrderAddress;

class Order extends Model
{
    use SoftDeletes;
    
    protected $table = 'orders'; 
    protected $fillable = ['order_address_id','user_id','seller_id','product_id','tax','other_tax','delivery_charges','total_price','coupon_added','coupon_name','coupon_price','grand_total','status','payment_type'];

    public function orderAddress(){
        return $this->belongsTo('App\Models\OrderAddress', 'order_address_id', 'id');
    }

    public function totalOrderCount(){
        return $this->hasMany('App\Models\Order', 'id', 'id')->count('user_id');
    }

    // public function totalSalePriceOrder(){
    //     return $this->hasOne('App\Models\OrderAddress', 'order_id', 'id');
    // }

    public function orderDetails(){
        return $this->hasMany('App\Models\ordersDetail', 'order_id', 'id');
    }

    public function seller(){
        return $this->belongsTo('App\Models\Seller', 'seller_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function orderStatus(){
        return $this->belongsTo('App\Models\OrderStatus', 'status', 'id');
    }

}
