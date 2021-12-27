<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    protected $table = 'product_carts'; 
    protected $fillable = ['user_id','product_id','product_quantity','product_name','product_quantity_price','total_price','color_id','size_id'];

    public function Product()
    {
        return $this->hasOne('App\Models\SellerProduct', 'id', 'product_id');
    } 
}
