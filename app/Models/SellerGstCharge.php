<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerGstCharge extends Model
{
    use HasFactory;

    protected $table     = 'seller_gst_charges';    
    protected $fillable  = ['seller_id','gst_number','gst_percentage','status'];

}
