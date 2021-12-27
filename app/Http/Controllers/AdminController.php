<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Auth;
use Crypt;
use Config;
use DataTables;
use App\Models\Admin;
use Exception;
use App\Traits\ImagesTrait;
use App\Models\Seller;
use App\Models\SellerProduct;
use App\Models\User;
use App\Models\Order;
use App\Models\BuisnessCategory;
use App\Models\UserAddress;
use App\Models\UserSupport;
use App\Models\ContactUs;
use App\Models\AdminContactInformation;
use App\Models\AdminAboutUsInformation;
use Validator;

class AdminController extends Controller
{
    use ImagesTrait;
    public function loginAdmin(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            if ($request->isMethod('post')) {
                // dd('here');
                if (isset($request->email)&&isset($request->password)) {
                    $admin = Admin::where('email',$request->email)->first();
                    if(isset($admin) && !empty($admin)){
                        $password = $admin->password;
                        // dd($request->has('remember_me'));
                        if (Hash::check($request->password,$admin->password)) {
                            if($admin->status == 'active'){
                                if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                                           // dd($request->has('remember_me'));
                                    Session::flash('success','Welcome '.$admin['full_name'].' to changarru');
                                    Session::flash('success','admin login successfully');
                                    return redirect('admin/dashboard');
                                }
                            }else{
                                Session::flash('error',('Deactivate account'));
                                return redirect()->back();  
                            }
                        } else {
                            // dd('wrong password');
                            Session::flash('error','Please enter a valid password');
                            return redirect()->back();  
                        }
                    } else {
                        // dd('jery');
                        Session::flash('error','Email or Password is incorrect');
                        return redirect()->back(); 
                    }
                } else {
                    Session::flash('error',Config::get(ADMN_MSGS.'.session.login.error.required_fields'));
                    return redirect()->back();
                }
            }
            return view('backend.login');
        } else {
            // dd('here');
            return redirect('admin/dashboard');
        }
        // dd('here');
        return view('backend.login');
    }

    public function forgotPassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->input();
            if (!empty($data)) {
                $exist = Admin::where('email',$data['email'])->first();
                if($exist){
                    $rand = $this->generateRandomString(8);
                    $id          = $exist->id;
                    $email       = $exist->email;
                    $password = '';
                    $links = array();
                    $links['full_name']   = $exist->full_name;
                    $links['password']     = $rand;
                    $links['image'] = asset('public/backend/assets/images/').'logo.png';
                    $subject = env('PROJECT_NAME')." Forgot Password";
                    Mail::send('backend.email.forgot_password', $links, function($message) use ($email,$subject){
                        $message->to($email)->subject($subject);
                    });

                    Admin::where('id',$exist->id)->update(['password'=>Hash::make($rand)]);
                    Session::flash('success','Password has been sent on your registered email');
                    return redirect('admin/login');
                } else {
                    Session::flash('error','Email not exist');
                    return redirect('admin/forgot-password');
                }
            } else {
                    Session::flash('error','Email not exist');
                    return redirect()->back();
            }   
        }
     return view('backend.forgotpassword');        
    }
    
    public function dashboard(){

        $sellers          = Seller::with('buisnessCategory')->get();
        $sellerPagination = Seller::orderBy('id','DESC')->paginate(10);
        $sellerProducts   = SellerProduct::get()->count();

        $users           = User::get();
        $usersPagination = User::orderBy('id','DESC')->paginate(10);
        $orders          = Order::get()->count();

        $adminDetail = Auth::guard('admin')->user();
        $page ='dashboard';
        return view('backend.index',compact('page','adminDetail','sellers','sellerProducts','users','orders','usersPagination','sellerPagination'));        
    }

    public function userList(Request $request){
        $input = $request->all();

        $usersPagination = User::withTrashed()->orderBy('id','DESC');
        $verified_status  = '';

        if(isset($_GET)){
            $verified_status   = @$_GET['verified_status'];

             if($verified_status=='verified' || $verified_status=='not_verified'){
                 $usersPagination = $usersPagination->where(function($q) use($verified_status){
                                $q->where('users.verified_status',$verified_status);
                     });
                $usersPagination       = $usersPagination->paginate(10);
             }elseif($verified_status=='deleted'){
                $usersPagination = $usersPagination->where(function($q) use($verified_status){
                               $q->where('users.deleted_at','!=',null);
                    });
                $usersPagination       = $usersPagination->paginate(10);
             }else{
                $usersPagination       = $usersPagination->paginate(10);
             }
        }else{
          $usersPagination          = $usersPagination->paginate(10);
        }




        // $usersPagination  = User::withTrashed()
        //                         ->orderBy('id','DESC')
        //                         ->paginate(10);

        $page             = 'user';
        return view('backend.users',compact('page','usersPagination'));        
    }

    public function userDelete(Request $request)
    {
        $response = [];
        $user = User::where('id',$request->id)->first();
        if($user){
            User::find($request->id)->delete();
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

    public function userRestored(Request $request)
    {
        $response = [];
        $user = User::withTrashed()->where('id',$request->id)->first();
        if($user){
            User::withTrashed()->find($request->id)->restore();
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

    public function userAddressList(Request $request,$user_id)
    {

        $userAddresses = UserAddress::where('user_id',base64_decode($user_id))->get();


        $userAddressesPaginate = UserAddress::where('user_id',base64_decode($user_id))
                                                ->paginate(10);
        $page        = 'user';
        return view('backend.address',compact('page','userAddresses','userAddressesPaginate'));
    }

    public function userAddressDelete(Request $request)
    {
        $input = $request->all();

        $response = [];
        $user = UserAddress::where('id',$input['id'])->first();
        // dd($input['id'],$input,$user);
        if($user){
            UserAddress::find($user['id'])->delete();
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

    
    public function shopList(){
        $sellers            = Seller::with('buisnessCategory')->orderBy('id','DESC')->get();
        $buisnessCategories = BuisnessCategory::orderBy('id','DESC')->get();
        $sellersPagination  = Seller::orderBy('id','DESC')->paginate(10);
        $page               = 'seller';
       return view('backend.shops',compact('page','sellers','sellersPagination','buisnessCategories'));       
    }
    
    public function updateShop(Request $request,$id){
        if($request->isMethod('post')){
            $payload = $request->except('_token');
            // dd($payload);
            $sellerUpdate = Seller::where('id',$payload['seller_id'])
                                    ->update([
                                        'buisness_name'         =>$payload['buisness_name'],
                                        'buisness_category_id'  =>$payload['buisness_category_id'],
                                        'verified_status'        =>$payload['verified_status']
                                    ]);
            if($sellerUpdate){
                Session::flash('success', 'Shop updated successfully');
                 return redirect('/admin/sellerManagement/seller/list');
            }else{
                 Session::flash('error','Something went wrong');
                 return redirect()->back();
            }
        }
        $seller = Seller::where('id',$id)->first();
        $buisnessCategories =DB::table('buisness_categories')
                                ->orderBy('id','DESC')->get();
        return view('backend.edit-shop',compact('seller','id','buisnessCategories'));
    }

    public function shopDelete(Request $request)
    {
        $response = [];
        // dd($request->id);
        $user = Seller::where('id',$request->id)->first();
        if($user){
            Seller::where('id',$request->id)->delete();
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }
    
    public function categoryList(){
        $categories            = DB::table('buisness_categories')
                                ->orderBy('id','DESC')->get();

        $categoriesPagination  = DB::table('buisness_categories')
                                ->orderBy('id','DESC')->paginate(10);
                                
        $page   = 'categories';
        return view('backend.categories',compact('page','categories','categoriesPagination'));       
    }

    public function addCategory(Request $request){
         // $BuisnessCategory = new BuisnessCategory();

        if($request->isMethod('post')){
            $payload = $request->except('_token');

            if(isset($payload['image'])){
                // dd($payload['image']);
                $image1 = isset($payload['image']) && !empty($payload['image']) ? $payload['image']:'';

                if($request->file('image')){ 
                    $directory ='backend/assets/images/buisness_category_image';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('image'), '');
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $buisness_category_image = $imagedata1['image'];
                    }
                }

                // if($admin['image'] && file_exists(public_path('backend/assets/images/buisness_category_image/'.$admin['image']))){
                //      unlink(base_path('public/backend/assets/images/buisness_category_image/'.$admin['image']));
                //  }
            }

            $sellerUpdate =  BuisnessCategory::create([
                                        'name'   => $payload['name'],
                                        'image'  => @$buisness_category_image
                                    ]);

            if($sellerUpdate){
                Session::flash('success', 'Buisness Category created successfully');
                 return redirect('/admin/categoryManagement/category/list');
            }else{
                 Session::flash('error','Something went wrong');
                 return redirect()->back();
            }
        }
        $page               = 'categories';
        return view('backend.add-category',compact('page'));
    }
    
    public function updateCategory(Request $request,$id){
        $buisnessCategory = DB::table('buisness_categories')
                                ->where('id',$id)
                                ->first();

        if($request->isMethod('post')){
            $payload = $request->except('_token');

            if(isset($payload['image'])){
                // dd($payload['image']);
                $image1 = isset($payload['image']) && !empty($payload['image']) ? $payload['image']:'';
                
                if($request->file('image')){ 
                    $directory ='backend/assets/images/buisness_category_image';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('image'), '');
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $buisness_category_image = $imagedata1['image'];
                    }
                }

                if($buisnessCategory['image'] && file_exists(public_path('backend/assets/images/buisness_category_image/'.$buisnessCategory['image']))){
                     unlink(base_path('public/backend/assets/images/buisness_category_image/'.$buisnessCategory['image']));
                 }
            }

            $sellerUpdate =  DB::table('buisness_categories')->where('id',$id)
                                    ->update([
                                        'name'   => $payload['name'],
                                        'image'  => @$buisness_category_image
                                    ]);
            if($sellerUpdate){
                Session::flash('success', 'Buisness Category updated successfully');
                 return redirect('/admin/categoryManagement/category/list');
            }else{
                 Session::flash('error','Something went wrong');
                 return redirect()->back();
            }
        }

        $page               = 'categories';
        return view('backend.editCategory',compact('page','id','buisnessCategory'));
    }

    public function categoryDelete(Request $request)
    {
        $data = $request->all();
        $response = [];
        $user = DB::table('buisness_categories')
                        ->where('id',$data['id'])->first();
        // dd($data);                        
        if($user){
            DB::table('buisness_categories')
                    ->where('id',$data['id'])
                    ->delete();

            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

    public function admin_profile(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();
            $admin =   Auth::guard('admin')->user();

            if(isset($input['image'])){
                // dd($input['image']);
                $image1 = isset($input['image']) && !empty($input['image']) ? $input['image']:'';
                if($request->file('image')){ 
                    $directory ='backend/assets/images/profile';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('image'), '');
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $adminImage = $imagedata1['image'];
                    }
                }
                $profile1 =  Admin::where('id',Auth::guard('admin')->user()->id)->update([
                           'image' => @$adminImage,
                        ]);


                if($admin['image'] && file_exists(public_path('backend/assets/images/profile/'.$admin['image']))){
                     unlink(base_path('public/backend/assets/images/profile/'.$admin['image']));
                 }
            }

            $profile =  Admin::where('id',Auth::guard('admin')->user()->id)
                            ->update([
                               'full_name'          =>@$input['full_name'],
                               'email'              =>@$input['email'],
                               'mobile_number'      =>@$input['mobile_number'],
                               'address'            =>@$input['address']
                               // 'image'           =>@$adminImage,
                            ]);

            if($profile || $profile1){
                return redirect('/admin/update-profile')->with('success','profile update successfully');
            }else{
                Session::flash('error','Something went wrong');
                return redirect()->back();
            }
        }
        $userList = Auth::guard('admin')->user();
        $page ='profile';
        return view('backend.admin.update-profile',compact('page','userList'));        
    } 

    public function changePasswordAdmin(Request $request) {
        if($request->isMethod('post')){
           $input = $request->all();
           $adminData = Admin::where('id',Auth::guard('admin')->user()->id)
                            ->update(['password'=>Hash::make($input['password'])]);
           Session::flash('success','Password changed successfully');
           return redirect('admin/dashboard');
        }
        return view('backend.admin.changepassword');
    }

      // contactUs
    public function contactUsQueryList(Request $request){
        $contactUs = ContactUs::get();
        $page = 'contact';
        return view('backend.contacts',compact('contactUs','page'));
     }
    
     public function contactUsQueryReply(Request $request)
     {
         $data = $request->all();
         $query_data = ContactUs::where('id',$data['contact_us_id'])->first();
         $query_data->update([
             'reply'=>$data['reply'],
             'is_reply' => 'yes',
         ]);
         $links = [];
         $email                  = $query_data['email'];
         $links['first_name']    = ucfirst($query_data['full_name']);
         $links['query']         = $query_data['message'];
         $links['reply']         = $query_data['reply'];
         
         $links['image'] = defaultAdminImagePath.'logo-dark.png';
         $subject = env('PROJECT_NAME')." Contact Us Query Reply";
         // dd('here');
         Mail::send('backend.email.contact_us_reply', $links, function($message) use ($email,$subject){
             $message->to($email)->subject($subject);
         });
         Session::flash('success', 'Query send successfully');
         return redirect()->back();
    } 

    public function cmsPageList(Request $request){
        $page = 'cms';
        return view('backend.cms_pages',compact('page'));        
    } 

    public function editContactPage(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();
            $update = AdminContactInformation::first();

            if(isset($input['contact_image'])){
                $image1 = isset($input['contact_image']) && !empty($input['contact_image']) ? $input['contact_image']:'';
                if($request->file('contact_image')){ 
                    $directory = 'admin/images/contactus';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('contact_image'), '');
                // dd($imagedata1);
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $image1 = $imagedata1['image'];
                    }
                }
            }

            if(!empty($update)){
                if(isset($image1)){
                    $update->contact_image              = @$image1;
                }
                $update->header_text          = @$request->header_text;
                $update->address              = @$request->address;
                $update->header_text_top      = @$request->header_text_top;
                $update->header_text_bottom   = @$request->header_text_bottom;
                $update->header_text_footer   = @$request->header_text_footer;
                $update->homepage_contact_text = @$request->homepage_contact_text;
                $update->email_1               = @$request->email_1;
                 if ($update->save()){             
                      return redirect()->back()->with('success','Admin Contact Information updated sucessfully');
                 }else{
                    Session::flash('error','Something went wrong');
                    return redirect()->back();
                }
            }
        }   
        $adminContactInformation = AdminContactInformation::orderby('created_at', 'desc')->first();
        // dd($adminContactInformation);
        return view('backend.contactPage',compact('adminContactInformation'));        
    } 

    //About Us Page
    public function editAboutUsPage(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();

            $validator = Validator::make(
                $request->all(),
                [
                   'image1_description' =>'required',
                   'image2_description' =>'required'
                ]
            );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
            $response['message'] = "missing parameters";
            return Redirect::back();
        }

            // dd($input);
            $update = AdminAboutUsInformation::first();   
            if(isset($input['image_1'])){
                $image1 = isset($input['image_1']) && !empty($input['image_1']) ? $input['image_1']:'';
                if($request->file('image_1')){ 
                    $directory = 'backend/assets/images/adminImage';
                    $type = 'logo';
                    $imagedata1 = $this->uploadimage($directory,$type, $request->file('image_1'), '');
                    if(isset($imagedata1) && $imagedata1 != ''){
                        $image1 = $imagedata1['image'];
                        // dd($image1);
                    }
                }
            }
            if(isset($input['image_2'])){
                $image2 = isset($input['image_2']) && !empty($input['image_2']) ? $input['image_2']:'';
                if($request->file('image_2')){ 
                    $directory = 'backend/assets/images/adminImage';
                    $type = 'logo';
                    $imagedata2 = $this->uploadimage($directory,$type, $request->file('image_2'), '');
                    if(isset($imagedata2) && $imagedata2 != ''){
                        $image2 = $imagedata2['image'];
                    }
                }
            }

            if(!empty($update)){
                if(isset($image1)){
                    $update->image_1                = @$image1; 
                }
                if(isset($image2)){ 
                    $update->image_2                = @$image2;
                }


                $update->image_description_1    = @$input['image1_description'];
                $update->image_description_2    = @$input['image2_description'];
                 
                 if ($update->save()){             
                      return redirect()->back()->with('success','Admin about us information updated sucessfully');
                 }else{
                    Session::flash('error','Something went wrong');
                    return redirect()->back();
                }
            }
        }   
        $adminContactInformation = AdminAboutUsInformation::orderby('created_at', 'desc')->first();
        return view('backend.aboutUsPage',compact('adminContactInformation'));        
    }

    public function adminlogout()
    {
        Auth::guard('admin')->logout();
        Session::flash('success','Admin logout successfully');
        return redirect('admin/login');
    }

    private function generateRandomString($length) {
        $characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return strtoupper($randomString);
    }

    public function getSupportList(Request $request){
        $userSupport     = UserSupport::with('user')->get()->toArray();
        $userSupportPagination = UserSupport::orderBy('id','DESC')->paginate(10);
        $page = 'support';
        return view('backend.support',compact('userSupport','page','userSupportPagination'));
    }

    public function supportDetail(Request $request,$supportId){
        $userSupportDetail = UserSupport::with('user')
                                    ->where('id',$supportId)
                                    ->first();
        
        $page = 'support';
        return view('backend.view-support',compact('userSupportDetail','page'));
    }

    public function supportDelete(Request $request)
    {
        $response = [];
        $user = UserSupport::where('id',$request->id)->first();
        if($user){
            UserSupport::find($request->id)->delete();
            $response['msg'] = 'true';
        }else{
            $response['msg'] = 'false';
        }
        return $response;
    }

}
