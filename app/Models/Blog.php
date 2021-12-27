<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mail;
use Illuminate\Database\Eloquent\SoftDeletes;
		
class Blog extends Model
{
    use SoftDeletes;
    
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    protected $table = 'blogs';
    
    protected $fillable = ['title','category_id','meta_title','meta_tag','meta_description','content','feature_image','slug','status','added_by'];

    public $timestamps = false;
    
    public function blogCategory()
    {
    	return $this->hasOne('App\Models\BlogCategory', 'id', 'category_id');
    }

    public function customerCommentBlogs()
    {
        return $this->hasMany('App\Models\Comment', 'blog_id', 'id');
    }
   
    public function createdBy(){
        return $this->hasOne('App\Models\Admin', 'id', 'added_by');   
    }

}


























