<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Admin;
use DataTables;
use Exception;
use Auth;
use Crypt;
use Config;
use App\Models\AdminAboutUsInformation;
use App\Traits\ImagesTrait;
use App\Models\ChangarruFeature;
use App\Models\Testimonial;
use App\Models\HomepageInformation;

class FeatureController extends Controller
{
    use ImagesTrait;

    public function index(Request $request)
    {
        $Features = ChangarruFeature::orderBy('id', 'desc')->get();
        return view('backend.changarruFeature.list', compact('Features'));
    }

    public function add(Request $request,$id = ''){

        if(!empty($id)){
            $changarruFeature = ChangarruFeature::find($id);     
        }else{
            $changarruFeature = new ChangarruFeature();
        }

        if ($request->isMethod('post')) {
            $input = $request->except('_token');    
             // dd($input); 
           
            $validator = $this->validate($request,  [
                        'feature_name'        => 'required',
                        'feature_description' => 'required',
                    ]
                );  

           // $inputs = $request->all();        
           $image = isset($changarruFeature->image) && !empty($changarruFeature->image) ? $changarruFeature->image:'';
            
            if($request->file('image')){ 
                $directory = 'admin/assets/img/Changarrufeature';
                $type = 'logo';
                $imagedata = $this->uploadimage($directory,$type, $request->file('image'), '');
                if(isset($imagedata) && $imagedata != ''){
                    $image = $imagedata['image'];
                }

                if(@$changarruFeature['image'] && file_exists(public_path('admin/assets/img/Changarrufeature/'.@$changarruFeature['image']))){
                     unlink(base_path('public/admin/assets/img/Changarrufeature/'.@$changarruFeature['image']));
                 }
            }

            $changarruFeature->feature_name         = $input['feature_name'];
            $changarruFeature->feature_description  = $input['feature_description'];
            $changarruFeature->image                = @$image;

            if($changarruFeature->save()){
                \Session::flash('success','Changarru features'.($id?'updated':'added').' Successfully.');    
                return redirect('/admin/changarru-feature');   
            }
        }
        return view('backend.changarruFeature.add', compact('changarruFeature','id'));
    }

    public function delete($id, Request $request)
    {   
        $response = [];
        $user = ChangarruFeature::where('id',$request->id)->first();
        if($user){
            ChangarruFeature::find($request->id)->delete();
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

    public function indexTestimonial(Request $request)
    {
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        return view('backend.testimonial.list', compact('testimonials'));
    }

    public function addTestimonial(Request $request,$id = ''){

        if(!empty($id)){
            $testimonial = Testimonial::find($id);     
        }else{
            $testimonial = new Testimonial();
        }

        if ($request->isMethod('post')) {
            $input = $request->except('_token');    
            // dd($input); 
            $validator = $this->validate($request,  [
                        'title'        => 'required',
                        'description' => 'required',
                    ]
                );  

            $testimonial->title         = $input['title'];
            $testimonial->description   = $input['description'];
             // dd($image); 

            if($testimonial->save()){
               \Session::flash('success','Testimonial'.($id?'updated':'added').' Successfully.');    
                return redirect('/admin/changarru-testimonial');   
            }
        }
        return view('backend.testimonial.add', compact('testimonial','id'));
    }

    public function deleteTestimonial($id, Request $request)
    {   
        $response = [];
        $user = Testimonial::where('id',$request->id)->first();
        if($user){
            Testimonial::find($request->id)->delete();
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

    public function updateHomepageInformation(Request $request){
        if($request->isMethod('post')){
            $input  = $request->all();
            // dd($input);
            $update = HomepageInformation::first();   
            if(isset($input['banner_image1'])){
                  $banner_image1 = isset($input['banner_image1']) && !empty($input['banner_image1']) ? $input['banner_image1']:'';
                  if($request->file('banner_image1')){ 
                      $directory = 'frontend/landingPage/assets/images';
                      $type = 'logo';
                      $imagedata1 = $this->uploadimage($directory,$type, $request->file('banner_image1'), '');
                      if(isset($imagedata1) && $imagedata1 != ''){
                          $banner_image1 = $imagedata1['image'];
                      }
                  }

                  if($update['banner_image1'] && file_exists(public_path('frontend/landingPage/assets/images/'.$update['banner_image1']))){
                       unlink(base_path('public/frontend/landingPage/assets/images/'.$update['banner_image1']));
                   }
              }

              if(isset($input['banner_image2'])){
                  $banner_image2 = isset($input['banner_image2']) && !empty($input['banner_image2']) ? $input['banner_image2']:'';
                  if($request->file('banner_image2')){ 
                      $directory = 'frontend/landingPage/assets/images';
                      $type = 'logo';
                      $imagedata1 = $this->uploadimage($directory,$type, $request->file('banner_image2'), '');
                      if(isset($imagedata1) && $imagedata1 != ''){
                          $banner_image2 = $imagedata1['image'];
                      }
                  }

                  if($update['banner_image2'] && file_exists(public_path('frontend/landingPage/assets/images/'.$update['banner_image2']))){
                       unlink(base_path('public/frontend/landingPage/assets/images/'.$update['banner_image2']));
                   }
              }
          
            if(isset($input['main_video'])){
                $input['main_video'] =  str_replace(' ', '_', $input['main_video']);
                $video = isset($input['main_video']) && !empty($input['main_video']) ? $input['main_video']:'';
                    if($request->file('main_video')){ 
                      $directory = 'frontend/landingPage/assets/images';
                      $type = 'logo';
                      $videoData = $this->uploadimage($directory,$type, $request->file('main_video'), '');
                      if(isset($videoData) && $videoData != ''){
                          $main_video = $videoData['image'];
                    }

                    if($update['main_video'] && file_exists(public_path('frontend/landingPage/assets/images/'.$update['main_video']))){
                       unlink(base_path('public/frontend/landingPage/assets/images/'.$update['main_video']));
                    }
                }
            }
            
            if(isset($input['step1_image'])){
                $step1_image = isset($input['step1_image']) && !empty($input['step1_image']) ? $input['step1_image']:'';
                if($request->file('step1_image')){ 
                    $directory = 'frontend/landingPage/assets/images';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('step1_image'), '');
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $step1_image = $imagedata1['image'];
                    }
                }

                if($update['step1_image'] && file_exists(public_path('frontend/landingPage/assets/images/'.$update['step1_image']))){
                     unlink(base_path('public/frontend/landingPage/assets/images/'.$update['step1_image']));
                 }
            }

            if(isset($input['step2_image'])){
                $step2_image = isset($input['step2_image']) && !empty($input['step2_image']) ? $input['step2_image']:'';
                if($request->file('step2_image')){ 
                    $directory = 'frontend/landingPage/assets/images';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('step2_image'), '');
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $step2_image = $imagedata1['image'];
                    }
                }

                if($update['step2_image'] && file_exists(public_path('frontend/landingPage/assets/images/'.$update['step2_image']))){
                     unlink(base_path('public/frontend/landingPage/assets/images/'.$update['step2_image']));
                 }
            }

            if(isset($input['step3_image'])){
                $step3_image = isset($input['step3_image']) && !empty($input['step3_image']) ? $input['step3_image']:'';
                if($request->file('step3_image')){ 
                    $directory = 'frontend/landingPage/assets/images';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('step3_image'), '');
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $step3_image = $imagedata1['image'];
                    }
                }

                if($update['step3_image'] && file_exists(public_path('frontend/landingPage/assets/images/'.$update['step3_image']))){
                     unlink(base_path('public/frontend/landingPage/assets/images/'.$update['step3_image']));
                 }
            }

            if(isset($input['header_logo'])){
                $header_logo = isset($input['header_logo']) && !empty($input['header_logo']) ? $input['header_logo']:'';
                if($request->file('header_logo')){ 
                    $directory = 'frontend/landingPage/assets/images/header-logo';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('header_logo'), '');
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $header_logo = $imagedata1['image'];
                    }
                }

                if($update['header_logo'] && file_exists(public_path('frontend/landingPage/assets/images/header-logo'.$update['header_logo']))){
                     unlink(base_path('public/frontend/landingPage/assets/images/header-logo'.$update['header_logo']));
                 }
            }
            


            if(!empty($update)){
                
                if(isset($header_logo)){
                      $update->header_logo             = @$header_logo;
                }

                if(isset($banner_image1)){
                      $update->banner_image1             = @$banner_image1;
                }

                if(isset($banner_image2)){
                      $update->banner_image2             = @$banner_image2;
                }

                if(isset($main_video)){
                      $update->main_video                = @$main_video;
                }

                if(isset($step1_image)){
                      $update->step1_image               = @$step1_image;
                }

                if(isset($step2_image)){
                      $update->step2_image               = @$step2_image;
                }

                if(isset($step3_image)){
                      $update->step3_image               = @$step3_image;
                }

                $update->page_title                = @$request->page_title;
                $update->title                     = @$request->title;
                $update->description               = @$request->description;
                $update->feature_title             = @$request->feature_title;
                $update->feature_description       = @$request->feature_description;
                $update->step1_title               = @$request->step1_title;
                $update->step1_description         = @$request->step1_description;
                $update->step2_title               = @$request->step2_title;
                $update->step2_description         = @$request->step2_description;
                $update->step3_title               = @$request->step3_title;
                $update->step3_description         = @$request->step3_description;
                $update->app_title                 = @$request->app_title;
                $update->app_description           = @$request->app_description;
                $update->google_play_store_link    = @$request->google_play_store_link;
                $update->apple_play_store_link     = @$request->apple_play_store_link;
                $update->footer_description        = @$request->footer_description;
                $update->see_more_information_step_1_button      = @$request->see_more_information_step_1_button;
                $update->see_more_information_step_1_name        = @$request->see_more_information_step_1_name;
                $update->see_more_information_step_1_link        = @$request->see_more_information_step_1_link;

                $update->see_more_information_step_2_button      = @$request->see_more_information_step_2_button;
                $update->see_more_information_step_2_name        = @$request->see_more_information_step_2_name;
                $update->see_more_information_step_2_link        = @$request->see_more_information_step_2_link;

                $update->see_more_information_step_3_button      = @$request->see_more_information_step_3_button;
                $update->see_more_information_step_3_name        = @$request->see_more_information_step_3_name;
                $update->see_more_information_step_3_link        = @$request->see_more_information_step_3_link;
                $update->video_title                             = @$request->video_title;
                $update->blog_title                              = @$request->blog_title;
                $update->category_title                          = @$request->category_title;
                $update->testimonial_title                       = @$request->testimonial_title;

                
                if ($update->save()){             
                    return redirect('admin/cms-page')->with('success','Homepage information updated successfully');
                }else{
                    Session::flash('error','Something went wrong');
                    return redirect()->back();
                }
            }
        } 

        $homepageInformation = HomepageInformation::orderby('created_at','desc')->first();
        $page='cms';
        return view('backend.homePageInformation', compact('homepageInformation','page'));
    }
    
}
