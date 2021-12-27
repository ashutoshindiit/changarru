<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerExtraCharge extends Model
{
    use HasFactory;

    protected $table     = 'seller_extra_charges';    
    protected $fillable  = ['seller_id','charge_type','charge_name','charges_in_percent','charges_in_flat_price','status'];
}
