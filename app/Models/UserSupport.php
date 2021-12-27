<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserSupport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table    = 'user_supports';
    protected $fillable = ['title','user_id','seller_id','description'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}



