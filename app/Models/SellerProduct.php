<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\SellerImage;

use App\Models\Unit;

use App\Models\SellerCategory;

use App\Models\Seller;

use App\Models\ProductCart;

use App\Models\SellerProductSize;

use App\Models\SellerProductColor;

use Auth;


class SellerProduct extends Model

{

    // use SoftDeletes;
    protected $table = 'seller_products';

    protected $fillable = ['seller_id','name','category_id','price','discounted_price','main_price','quantity','unit_id','description','product_slug','product_view_count','weight','length','height','width'];

    public $timestamps = false;

    public function sellerProductImages()

    {
        return $this->hasMany('App\Models\SellerImage', 'product_id', 'id');
    }


    public function sellerUnit()

    {
        return $this->hasOne('App\Models\Unit', 'id', 'unit_id');
    }



    public function sellerInfo()

    {
        return $this->hasOne('App\Models\Seller', 'id', 'seller_id');
    }



    public function sellerCategory()

    {
        return $this->hasOne('App\Models\SellerCategory', 'id', 'category_id');
    } 



    public function productCart()

    {
        if (Auth::check()) {

            $userId  = Auth::user()->id;
        } else{
           $userId   = @$_COOKIE['guestId'];
        }
        return $this->hasOne('App\Models\ProductCart', 'product_id', 'id')->where('user_id',$userId);
    }


    public function sellerProductColors()
    {
        return $this->hasMany('App\Models\SellerProductColor', 'product_id', 'id');
    }

    public function sellerProductSizes()
    {
        return $this->hasMany('App\Models\SellerProductSize', 'product_id', 'id');
    }
 

}





















































