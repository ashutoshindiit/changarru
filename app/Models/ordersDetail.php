<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Seller;

class ordersDetail extends Model
{
     use SoftDeletes;

    protected $table = 'order_details'; 
    protected $fillable = ['order_id','seller_id','product_id','product_quantity','product_quantity_price','product_variant','product_variant_color','size_id','color_id'];

    public function seller(){
        return $this->belongsTo('App\Models\Seller', 'seller_id', 'id');
    }

    public function orderProduct(){
        return $this->hasOne('App\Models\SellerProduct', 'id', 'product_id');
    }
    
}
