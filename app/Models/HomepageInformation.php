<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageInformation extends Model
{
    use HasFactory;
    protected $table = 'homepage_informations';
    protected $fillable = ['title','page_title','hagel_main_video','description','banner_image1','banner_image2','feature_title','feature_description','step1_title','step1_description','step1_image','step2_title','step2_description','step2_image','step3_title','step3_description','step3_image','footer_description','see_more_information_step_1_link','see_more_information_step_1_button','see_more_information_step_1_name','see_more_information_step_2_link','see_more_information_step_2_button','see_more_information_step_2_name','see_more_information_step_3_link','see_more_information_step_3_button','see_more_information_step_3_name','header_logo','video_title','blog_title'];
}

 

