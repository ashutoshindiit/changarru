<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Seller;
		

class SellerCategory extends Model
{
    use SoftDeletes;

    protected $table = 'seller_categories';
    
    protected $fillable = ['name','seller_id','image'];
    protected $appends = ['full_image_url'];
    public $timestamps = false;

    public function seller()
    {
        return $this->hasOne('App\Models\Seller', 'id', 'seller_id');
    }

    
    public function getFullImageUrlAttribute() // notice that the attribute name is in CamelCase.
    {
        return url('/').'/frontend/assets/img/productCategoryImage/'.$this->image;
    }
    
    public function sellerProducts()
    {
        return $this->hasMany(SellerProduct::class, 'category_id');
    }
}


























