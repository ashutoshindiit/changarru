<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
	use SoftDeletes;

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_PENDING = 'pending';	
	const STATUS_DISABLE = 'disable';
	
    use HasFactory;
    
    protected $table = 'blog_categories';
    protected $fillable = ['category_name','status'];

    public function Blogs()
    {
        return $this->hasMany('App\Models\Blog', 'category_id', 'id')->where('status', '=', 'enable');
    }
} 
