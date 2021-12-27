<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangarruFeature extends Model
{
    use HasFactory;

    protected $table = 'changarru_features';
    protected $fillable = ['feature_name','feature_description','image'];
}
