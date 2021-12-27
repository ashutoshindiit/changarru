<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerAdditionalInformation extends Model
{
    protected $table = 'seller_additional_informations';
    protected $fillable = ['seller_id','field_name','field_type','is_required'];
    
}


























