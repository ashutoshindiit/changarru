<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SellerImage;
use App\Models\Unit;
use App\Models\SellerCategory;
use App\Models\Seller;
use App\Models\ProductCart;
		

class SellerProductColor extends Model
{
    use SoftDeletes;

    protected $table = 'seller_products_colors';
    
    protected $fillable = ['seller_id','product_id','name','color_code'];

    public $timestamps = false;

       
}


























