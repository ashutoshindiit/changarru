<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
		
class BuisnessCategory extends Model
{
    use SoftDeletes;

    protected $table = 'buisness_categories';
    
    protected $fillable = ['name','image'];

    public $timestamps = false;

}


























