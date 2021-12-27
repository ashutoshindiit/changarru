<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Auth;
use Crypt;
use Config;
use DataTables;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Admin;
use App\Models\User;
use App\Models\Country;
use App\Models\Job;
use App\Models\JobImage;
use App\Models\TypeOfWork;
use App\Models\Language;
use App\Models\JobServiceProvide;
use App\Models\Subscription;
use App\Models\Privacy;
use App\Models\Term;
use App\Models\UserBooking;
use App\Models\contactUs;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\ImagesTrait;
use Exception;



class BlogController extends Controller
{
      use ImagesTrait;

        public function index(Request $request)
        {
            $blogs  = Blog::with('blogCategory')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
            $page = 'blog';
            return view('backend.blogs.list', compact('blogs','page'));
        }


        public function add(Request $request,$id = ''){
          
            if(!empty($id)){
                $blog = Blog::with('blogCategory')->find($id);     
            }else{
                $blog = new Blog();
            }

            if ($request->isMethod('post')) {
                $input = $request->all();    
                $validator = $this->validate($request,  [
                            'title'             => 'required',
                            'category_id'       => 'required',
                            // 'meta_title'        => 'required',
                            // 'meta_tag'          => 'required',
                            // 'meta_description'  => 'required|max:150',
                            'content'           => 'required',
                            'status'            => 'required',
                            'slug'              => 'required|unique:blogs,slug,'.$id,
                        ]
                    );  

                $inputs = $request->all();        
                $image = isset($blog->feature_image) && !empty($blog->feature_image) ? $blog->feature_image:'';
                
                if($request->file('feature_image')){ 
                    $directory = 'backend/assets/images/blog';
                    $type = 'logo';
                    $imagedata = $this->uploadimage($directory,$type, $request->file('feature_image'), '');
                    if(isset($imagedata) && $imagedata != ''){
                        $image = $imagedata['image'];
                    }

                   if($blog['feature_image'] && file_exists(public_path('backend/assets/images/blog/'.$blog['feature_image']))){
                        unlink(base_path('public/backend/assets/images/blog/'.$blog['feature_image']));
                    }
                }
                
                $blog->title             = @$inputs['title'];
                $blog->category_id       = @$inputs['category_id'];
                // $blog->meta_title        = @$inputs['meta_title'];
                // $blog->meta_tag          = @$inputs['meta_tag'];
                // $blog->meta_description  = @$inputs['meta_description'];
                $blog->content           = @$inputs['content'];
                $blog->status            = @$inputs['status'];
                $blog->feature_image     = @$image;
                $blog->slug              = @$inputs['slug'];
                $blog->added_by          = Auth::guard('admin')->user()->id;

                if($blog->save()){
                    $description = ($id?'Updated':'Added').' the blog '.$blog->name;

                    \Session::flash('success','Blog '.($id?'updated':'added').' Successfully.');    
                    return redirect('/admin/blogs');   
                }
            }
            $blogCategories  = BlogCategory::get();   
            return view('backend.blogs.add', compact('blog', 'id','blogCategories'));  
        }

        public function delete($id, Request $request)
        {   
            $response = [];
            $blog = Blog::find(base64_decode($id));
            if(!empty($blog)){
                if ($blog['feature_image'] && file_exists(public_path('backend/assets/images/blog/'.$blog['feature_image']))){
                    unlink(public_path('backend/assets/images/blog/'.$blog['feature_image']));
                }
                Blog::where('id',base64_decode($id))->delete();
                $response['msg'] = 'true';
            }else{
                $response['msg'] = 'false';
            }
            return $response;
        }
        /////////////Blog Category///////////////////////////////////
       
       public function indexCategory(Request $request)
       {
           $blogCategories = BlogCategory::orderBy('id', 'desc')->get();
           $page = 'blogCategory';
           return view('backend.blogs.blogCategory.list', compact('blogCategories'));
       }

        public function addCategory(Request $request,$id = ''){
            if(!empty($id)){
                $blogCategory = BlogCategory::find($id);
            }else{
               $blogCategory = new BlogCategory();
            }
           if ($request->isMethod('post')) {
               $input = $request->all();
               $validator = $this->validate($request,  [
                           'category_name' => 'required|unique:blog_categories,category_name,'.$id,
                            'status'       => 'required',
                       ]
                   );  

               $blogCategory->category_name   = @$input['category_name'];
               $blogCategory->status         = @$input['status'];
             
               if($blogCategory->save()){
                   $description = ($id?'Updated':'Added').' the blog category '.$blogCategory->category_name;
                   if($request->ajax()){
                       if(empty($id)){
                           return array('code' => 700, 'message' => 'Category added successfully', 'id' => $blogCategory->id);
                       }else{
                           \Session::flash('success','Category '.($id?'updated':'added').' Successfully.');    

                            return array('code' => 600, 'message' => 'Category added successfully', 'url' => url('admin/blogs'), 'status'=> 'Success');
                       }
                   } 
                   \Session::flash('success','Category '.($id?'updated':'added').' Successfully.');    
                   return redirect('/admin/blogs-categories');   
               }

           }
           return view('backend.blogs.blogCategory.add', compact('blogCategory', 'id'));
       }
       // dd($input);
       public function deleteCategory($id, Request $request)
       {
           $array = explode('_', $id);
           $blogCategory = BlogCategory::where('id', $array[0])->withTrashed()->first();
           $categoryExistInBlog = Blog::with('blogCategory')->where('category_id',$blogCategory['id'])
                                        ->get()
                                        ->count();

           if($categoryExistInBlog ==0){
               if(@$array[1] == 'restore'){
                   $restoreCategory =  BlogCategory::withTrashed()->where('id',$array[0])->restore();
                   $blogCategory->status = '1';
                   $blogCategory->save();
                    Session::flash('success', 'Blog Category restore successfully');
                    return redirect('admin/blogs-categories');
               }else{ 
                    BlogCategory::where('id', $array[0])->update(['status'=>'3']);
                    BlogCategory::where('id', $array[0])->delete();
                    Session::flash('success', 'Blog Category deleted successfully');
                    return redirect('admin/blogs-categories');            
               }
              
           }else{
            Session::flash('error', 'Category cannot be deleted due to existance of blog.');
            return redirect('admin/blogs-categories');      
           }
       }

       public function categoryStatus($id){
           $blog = BlogCategory::find($id);
           if(empty($blog)){
               return response()->json(['error'=>"Category is not available."]);
           }

          if($blog->status == 1){
               $blog->status = BlogCategory::STATUS_INACTIVE;
               $status = 'Disable';
           }else{
               $blog->status = BlogCategory::STATUS_ACTIVE;
               $status = 'Enable';  
           }

           $blog->save();
           $description = $status.' the blog '.$blog->name;
           // $this->createStaffActivityLog($description, $blog->id);
           \Session::flash('success',"Category ".($status == 'Enable' ? 'activated':'deactivated')." successfully");  
           return response()->json(['success'=>"Category ".($status == 'Enable' ? 'activated':'deactivated')." successfully"]);
       }
}
