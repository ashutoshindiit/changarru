<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerImage extends Model
{
    use SoftDeletes;
    protected $table = 'seller_images';
    
    protected $fillable = ['product_id','image','thumbnail_image'];
    public $timestamps = false;

    
}


























