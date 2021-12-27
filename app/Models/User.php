<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';
    protected $fillable = ['mobile_number','otp','verified_status','isd_code'];

    public function userAddress()
    {
        return $this->hasOne('App\Models\UserAddress', 'user_id', 'id');
        
    }
}











