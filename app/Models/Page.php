<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

		
class Page extends Model
{
 

    protected $table     = 'pages';
    
    protected $fillable  = ['type','user_id','page_name','title','description'];

    public $timestamps   = false;
}
























