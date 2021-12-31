<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BuisnessCategory;
use App\Models\SellerDiscountCoupon;
use App\Models\SellerProduct;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

// use Illuminate\Contracts\Auth\Authenticatable;
// use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends  Authenticatable implements JWTSubject{
    use SoftDeletes;
    use Notifiable;

    public function getJWTIdentifier()
    {
       return $this->getKey();
    } 

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $table = 'sellers';
    
    protected $fillable = ['isd_code','mobile_number','buisness_name','buisness_category_id','slug','otp','verified_status','store_view_count','store_image','store_address','store_url','email','street','street2','zipcode'];

    public $timestamps = false;

    public function buisnessCategory()
    {
        return $this->hasOne('App\Models\BuisnessCategory', 'id', 'buisness_category_id');
    }

    public function page()
    {
        return $this->hasOne('App\Models\Page', 'id', 'user_id');  
    }

    public function sellerDiscountCoupons()
    {
        return $this->hasMany('App\Models\SellerDiscountCoupon', 'seller_id', 'id');
    }

    public function sellerProduct()
    {
        return $this->hasMany('App\Models\SellerProduct', 'seller_id', 'id');
    }

}
























