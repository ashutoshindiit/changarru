<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAboutUsInformation extends Model
{
    use HasFactory;
    protected $table = 'admin_about_us_informations';
    protected $fillable = ['image_1','image_description_1','image_2','image_description_2','description','hagel_about_video'];
}
