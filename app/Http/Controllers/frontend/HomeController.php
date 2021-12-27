<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use App\Models\BuisnessCategory;
use App\Models\Seller;
use App\Models\SellerCategory;
use App\Models\SellerImage;
use App\Models\SellerProduct;
use App\Models\Unit;
use App\Models\ProductCart;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Mail;
use App\Models\UserSupport;
use App\Models\Order;
use App\Models\ordersDetail;
use App\Models\SellerCharge;
use App\Models\SellerExtraCharge;
use App\Models\SellerDiscountCoupon;
use App\Models\PrivacyPolicy;
use App\Models\TermAndCondtion;
use App\Models\OrderStatus;
use App\Models\OrderAddress;
use App\Models\SellerProductColor;
use App\Models\SellerProductSize;
use Twilio\Rest\Client;
use DateTime;
use Date;
use Auth;
use App\Models\SellerAdditionalInformation;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\ChangarruFeature;
use App\Models\HomepageInformation;
use App\Models\Testimonial;
use App\Models\Page;
use GuzzleHttp\Client as GuzzleClient;

class HomeController extends Controller

{
    public function registerWithMobile(Request $request)
     {
        $data = $request->all();
        $response= [];
        $User = User::withTrashed()->where('mobile_number', $data['mobile_number'])->first();
        // dd($data,$User);

        if($User){
            $response['userId'] = $User['id'];
            $response['status']='true';
            $response['msg']= 'Mobile no. has been verified';      
        }else{


            // $twillio = $this->sendMessage('User registration successful!!', "+919781441593");

            // if($twillio['status'] == 0){
            //     $response['status'] = 'false';
            //     $response['msg']    = 'Something went wrong';
            // }else{
            //     $userId = User::create([
            //                     'mobile_number'   =>  $data['mobile_number'],
            //                     'isd_code'        =>  $data['isd_code'],  
            //                     'verified_status' =>  'verified',
            //                     'otp'             =>  $twillio['otp']
            //               ])->id;

            //     $response['userId'] = $userId;
            //     $response['status'] = 'true';
            //     $response['msg']    = 'Enter otp that you recieved on your registered mobile number';

            // }

                $otp = '123456';

                $userId = User::create([
                                'mobile_number'   =>  $data['mobile_number'],
                                'isd_code'        =>  $data['isd_code'],  
                                'verified_status' =>  'verified',
                                'otp'             =>  $otp
                          ])->id;

                $response['userId'] = $userId;
                $response['status'] = 'true';
                $response['msg']    = 'Enter otp that you recieved on your registered mobile number';
        }
        return $response; 
    }
    

 
    private function sendMessage($message, $recipients)
    {
        $from_number  = '+14502346234';
       $client = new Client('ACa06692a38885db8acc0e0fd35925915d', '63ab829af973f3d63910d84cf1acb0cb');
       $otp = random_int(100000, 999999);
       $phone_number = '+919816337160';
       $otp_message = $otp;
               try{
                   $sms = $client->messages->create(
                       '+'.$phone_number,
                       array(
                        'from' => $from_number,
                        'body' => $otp_message.' '.$otp
                       )
                   );

                   if(!empty($sms->sid)){
                   $data['status'] = 1;
                   $data['otp'] = $otp;
                   }
                   else{
                       $data['error'] = 'dfdxfdsfdsf';
                       $data['status'] = 0;
                   }
               }
               catch (Exception $e){
                   $data['error'] = $e->getMessage();
                   $data['status'] = 0;
                  
               }
                return $data;

    }

    public function otpVerification(Request $request)
     {
        $data = $request->all();
        $response= [];
        $User = User::withTrashed()->where('otp',$data['otp'])
                      ->where('id', $data['userId'])
                      ->first();      

        if($User){
            if($User['deleted_at']!=null){
                    $response['status'] = 'flase';
                    $response['msg']    = 'Your account has been suspended. Please contact site admin';  
                    return $response; 
            }
            auth()->loginUsingId($User['id']);
            $user_id     = Auth::user()->id;
            User::where('id',$user_id)->update(['verified_status'=>'verified']);
            $guest_id    = @$_COOKIE['guestId'];

            ProductCart::where('user_id',$guest_id)
                        ->update(['user_id'=> $user_id ]);

            if ($data['WithoutLogin_final_price'] !=null || $data['WithoutLogin_tax']!=null || $data['WithoutLogin_grand_total_price']!=null ) {
                
                $getOrderStatus = OrderStatus::get();
                $sellerCharge   = SellerCharge::where('seller_id',1)
                                            ->where('gst','active')->first();

                $sellerExtraCharge = SellerExtraCharge::where('seller_id',1)->get();
                $response= [];

                $firstAddressRecordData = UserAddress::where('user_id',$guest_id)
                                                ->update(['user_id'=> $user_id ])
                                                ;
                $firstAddressRecord     = UserAddress::where('use_address_as_default','yes')    
                                            ->where('user_id',$user_id)    
                                            ->first();
                 // dd($data);                                
                $orderAddressId = OrderAddress::create([
                                            'user_id'       => Auth::user()->id,
                                            'name'          => $firstAddressRecord['name'],
                                            'address'       => $firstAddressRecord['address'],
                                            'isd_code'      => $firstAddressRecord['isd_code'],
                                            'city'          => $firstAddressRecord['city'],
                                            'pincode'       => $firstAddressRecord['pincode'],
                                            'mobile_number' => $firstAddressRecord['mobile_number']
                                        ])->id;
         
                $orderId    = Order::create([
                                'user_id'               => @$user_id,
                                'order_address_id'      => $orderAddressId,
                                'total_price'           => $data['WithoutLogin_final_price'],
                                'coupon_added'          => (Session::has('coupon_name')) ? 'yes' :'no',
                                'coupon_name'           => (Session::has('coupon_name')) ? Session::get('coupon_name') :null,
                                'coupon_price'          => (Session::has('discounted_Amount')) ? Session::get('discounted_Amount'):null,
                                'tax'                   => $data['WithoutLogin_tax'],
                                'other_tax'             => json_encode($sellerExtraCharge),
                                'grand_total'           => $data['WithoutLogin_grand_total_price'],
                                'status'                => $getOrderStatus['0']['id'],
                                'payment_type'          => 'cash',
                                'addtional_information' =>  (Session::has('SellerAdditionalInformationData')) ? json_encode(Session::get('SellerAdditionalInformationData')):null
                    ])->id;
                

                $cartItems  = ProductCart::where('user_id',$user_id)->get();

                foreach ($cartItems as $key => $value) {
                    $productCart = SellerProduct::where('id',$value['product_id'])->first();

                    $cartProductCount   = ProductCart::where('user_id',$user_id)
                                            ->where('product_id',$value['product_id'])
                                            ->first();

                    ordersDetail::create([
                                    'order_id'               =>  $orderId,
                                    'seller_id'              =>  $productCart['seller_id'],
                                    'product_id'             =>  $value['product_id'],
                                    'product_quantity'       =>  $value['product_quantity'],
                                    'product_quantity_price' =>  $value['product_quantity_price'],
                                    'size_id'                =>  @$value['size_id'],
                                    'color_id'               =>  @$value['color_id']
                    ]);

                    Order::where('id',$orderId)->update([
                                        'seller_id'  => $productCart['seller_id'],
                                    ]);
                    

                    $productCount        =  SellerProduct::where('id',$value['product_id'])->first();
                                                                                
                    $updatedProductQuantity = $productCount['quantity']-$cartProductCount['product_quantity'];

                    SellerProduct::where('id',$value['product_id'])
                                    ->update([
                                               'quantity'=>$updatedProductQuantity
                                            ]);
                }
                // product_id   
                $cartItems = ProductCart::where('user_id',$user_id)->delete();
                Session::forget('discounted_Amount');
                Session::forget('discount_price');
                Session::forget('discount_type');
                Session::forget('coupon_name');
                Session::forget('SellerAdditionalInformationData');
                
            }
            $productCart = ProductCart::where('user_id',$user_id)
                                        ->get();
            $response['status'] = 'true';
            $response['msg']    = 'Welcome to my orders';      
        }else{
            $response['status'] = 'flase';
            $response['msg']    = 'Otp was incorrect, try again';      
        }

        return $response; 
    }
    

    public function withoutLoginConfirmOrder(Request $request){

        $data = $request->all(); 
        $response= [];

        if ($data['additionalfields']) {
            Session::put('SellerAdditionalInformationData', $data['additionalfields']);
        }       

        $userId   = @$_COOKIE['guestId'];

        $userAddressId = UserAddress::create([
                'isd_flag'      => @$data['isd_flag'],
                'user_id'       => @$userId,
                'isd_code'      => '+'.$data['isd_code'],
                'name'          => $data['name'],
                'address'       => $data['address'],
                'city'          => $data['city'],
                'pincode'       => $data['pincode'],
                'mobile_number' => $data['mobile_number'],
                'use_address_as_default' =>'yes'
            ])->id;

        if(empty($userAddressId)){

           $response['status'] = 'false';
           $response['msg']    = 'Something went wrong';

        }else{
           $response['final_price'] = $data['final_price'];
           $response['tax'] = $data['tax'];
           $response['grand_total_price'] = $data['grand_total_price'];

           $response['userId'] = $userId;

           $response['status'] = 'true';

           $response['msg']    = 'Address  added successfully';

        }

        return $response; 

    }

    

    public function paymentMethod(Request $request,$slug)
    {
        $page ='payment';
        return view('frontend.payments',compact('slug','page'));
    }

    public function myOrders(Request $request,$slug)
    {
        try {
            $allOrder = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','orderStatus')
                                ->withCount(['orderDetails'])
                               ->where('user_id',Auth::user()->id)
                               ->orderBy('id','DESC')
                               ->get();

            // dd($allOrder); 
            $orderStatuses = OrderStatus::get();

            $sellers  = Seller::with('buisnessCategory')
                                  ->where('slug',$slug)
                                  ->first();

            $sellerProductsCategoryCount = SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                                ->where('seller_id',$sellers['id'])
                                                ->distinct('category_id')
                                                ->pluck('category_id');

            $allCategories = SellerCategory::whereIn('id',$sellerProductsCategoryCount)->get();
            $page ='myOrder';

            return view('frontend.order',compact('slug','page','allOrder','orderStatuses','allCategories'));

        } catch (Exception $e) {

            \Log::error($e->getMessage());

        }

    }



    public function renderMyOrder (Request $request){

        $payload = $request->all();

        // dd($payload);

        $allOrder = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','orderStatus')

                            ->where('user_id',Auth::user()->id)

                            ->where('status',$payload['status_Id'])

                            // ->orderBy('order_status', 'asc')

                            ->get();

        return view('frontend.element.renderMyOrder', ['allOrder' => $allOrder,'slug'=>$payload['slug']])->render();
    }

    public function myOrderDetail(Request $request,$slug,$orderId){

        $myOrder = Order::with('orderAddress','orderDetails','orderDetails.seller','seller')
                            ->withCount(['orderDetails'])
                            ->where('user_id',Auth::user()->id)
                            ->where('id',$orderId)
                            ->first();
                            
        $sellerProduct  = ordersDetail::with('orderProduct','orderProduct.sellerProductColors','orderProduct.sellerProductSizes','orderProduct.sellerInfo','orderProduct.sellerProductImages','orderProduct.sellerUnit','orderProduct.sellerCategory')->where('order_id',$orderId)->get();

        // dd($sellerProduct);                     

        // $sellerProduct   = SellerProduct::whereIn('id',$pluckProduct)
        //                             ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
        //                             ->get();
        
        $page ='myOrder';
        return view('frontend.orderdetails',compact('slug','page','myOrder','sellerProduct','orderId'));
    }

    public function myAddresses(Request $request,$slug)
    {
        try {
            $userAddresses = UserAddress::where('user_id',Auth::user()->id)->get();
            // dd($userAddresses);

            $page ='address';
            return view('frontend.address',compact('slug','page','userAddresses'));
        } catch (Exception $e) {
            \Log::error($e->getMessage());
        }

    }


    public function logout(Request $request,$slug) {

        try{

            if (Auth::check()) {

                Session::flush();

                Auth::logout();

            }

            session::flash('success',trans('Session logout successfully'));

            return redirect('/'.$slug);

        }catch(Exception $e){

            \Log::error($e->getMessage());

            Session::flash('error',trans('Something went wrong'));

            return redirect()->back();

        }

    }



    public function addMyAddress(Request $request){

        $data = $request->all(); 

        $response= [];

        // dd($data);

        $recordFound = UserAddress::where('user_id',Auth::user()->id)->first();

        if($recordFound){

            $userAddress = UserAddress::create([

                                'isd_flag'      => @$data['isd_flag'],

                                'user_id'       => Auth::user()->id,

                                'isd_code'      => '+'.$data['isd_code'],

                                'name'          => $data['name'],

                                'address'       => $data['address'],

                                'city'          => $data['city'],

                                'pincode'       => $data['pincode'],

                                'mobile_number' => $data['mobile_number'],
                                
                                'street' => $data['street'],
                                
                                'street2' => $data['street2'],

                            ])->id;

        }else{

            $userAddress = UserAddress::create([

                                    'isd_flag'      => @$data['isd_flag'],

                                    'user_id'       => Auth::user()->id,

                                    'isd_code'      => '+'.$data['isd_code'],

                                    'name'          => $data['name'],

                                    'address'       => $data['address'],

                                    'city'          => $data['city'],

                                    'pincode'       => $data['pincode'],

                                    'mobile_number' => $data['mobile_number'],

                                    'use_address_as_default' =>'yes',
                                    
                                    'street' => $data['street'],
                                
                                    'street2' => $data['street2'],

                                ])->id;

        }

  

        if(empty($userAddress)){

           $response['status'] = 'false';

           $response['msg']    = 'Something went wrong';

        }else{

           $response['status'] = 'true';

           $response['msg']    = 'Address  added successfully';

           $userAddresses = UserAddress::where('user_id',Auth::user()->id)->get();

           $view1 = view('frontend.element.allAddress', ['userAddresses'=>$userAddresses])->render();

           $view2 = view('frontend.element.allAddressRenderCheckout', ['userAddresses'=>$userAddresses])->render();
        }

        $view    = array('renderData2'=>$view2,'renderData'=>$view1,'response'=>$response);

        echo json_encode($view); 

    }



    public function updateMyAddress(Request $request){

        $data = $request->all(); 
        // dd($data);
        $response= [];

        UserAddress::where('id',$data['id'])

                            ->update([

                                'isd_code'      => '+'.$data['isd_code'],

                                'name'          => $data['name'],

                                'address'       => $data['address'],

                                'city'          => $data['city'],

                                'pincode'       => $data['pincode'],

                                'mobile_number' => $data['mobile_number']
                            ]);



       $response['status'] = 'true';

       $response['msg']    = 'Address  updated successfully';

       $userAddresses = UserAddress::where('user_id',Auth::user()->id)->get();

       $view11 = view('frontend.element.allAddress', ['userAddresses'=>$userAddresses])->render();

       $view = array('renderData'=>$view11,'response'=>$response);

       echo json_encode($view); 

    }



    public function deleteMyAddress(Request $request){

        $data = $request->all(); 

        $response= [];

        UserAddress::where('user_id',Auth::user()->id)

                     ->where('id',$data['userAddressId'])

                     ->delete();

    

       $response['status'] = 'true';

       $response['msg']    = 'Address  deleted successfully';



       $userAddresses = UserAddress::where('user_id',Auth::user()->id)->get();

       $view11 = view('frontend.element.allAddress', ['userAddresses'=>$userAddresses])->render();

       

        $view = array('renderData'=>$view11,'response'=>$response);

        echo json_encode($view); 

    }



    // public function getSupport(Request $request,$slug){

    //    if ($request->isMethod('post')) {

    //        $input = $request->all();

    //        $validator = $this->validate($request,  [

    //                    'title'        => 'required',

    //                    'description'  => 'required',

    //                ]); 

                    

    //        UserSupport::create([

    //                     'user_id'       => Auth::user()->id,

    //                     'title'         => $input['title'],

    //                     'description'   => $input['description']

    //                 ]);



    //        $email                   = 'changarruHelp@mailinator.com';

    //        $links                   = array();

    //        $links['title']          = $input['title'];

    //        $links['description']    = $input['description'];

    //        $subject                 = env('PROJECT_NAME')." Support";



    //        Mail::send('frontend.emails.contact_us_query', $links, function($message) use ($email,$subject){

    //            $message->to($email)->subject($subject);

    //        });



    //        \Session::flash('success','Mail send successfully.');    

    //        return redirect('/'.$slug.'/support');   

    //    }  

    //    $page ='support';

    //    return view('frontend.support',compact('slug','page'));  

    // } 



    public function getSupport(Request $request,$slug){

       if ($request->isMethod('post')) {

           $input = $request->all();

           // dd($input);

           $validator = $this->validate($request,  [

                       'title'        => 'required',

                       'description'  => 'required',

                       'seller_id'  => 'required',

                   ]); 

                    

           UserSupport::create([

                        'user_id'       => Auth::user()->id,

                        'seller_id'     => $input['seller_id'],

                        'title'         => $input['title'],

                        'description'   => $input['description']

                    ]);



           \Session::flash('success','Support send successfully.');    

           return redirect('/'.$slug.'/support');   

       }  

       $sellers   = Seller::with('buisnessCategory')

                                        ->get();                                        

       $page ='support';

       return view('frontend.support',compact('slug','page','sellers'));  

    }     



    public function dashboard(Request $request , $slug='') { 
      if(empty($slug)){
        $blogs  = Blog::with('blogCategory')
                        ->whereNull('deleted_at')
                        ->orderBy('id','desc')
                        ->get();
        
        $sellerCategories = SellerCategory::whereNull('deleted_at')
                                            ->orderBy('id','desc')
                                            ->get();

        $ChangarruFeatures   = ChangarruFeature::orderBy('id','desc')
                                            ->limit('4')
                                            ->get();

        $homepageInformation = HomepageInformation::first();

        $testimonials = Testimonial::get();

        $pages = Page::get();   

        return view('frontend.landingPages.index',compact('blogs','sellerCategories','ChangarruFeatures','homepageInformation','testimonials','pages'));
      }
      $input = $request->all();
      $sellers  = Seller::with('buisnessCategory')->where('slug',$slug)->first();
      
      Seller::where('id',$sellers['id'])
                ->update([
                    'store_view_count' => $sellers['store_view_count']+1
                ]);

      $sellerProducts = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                ->where('seller_id',$sellers['id'])
                                ->orderBy('id','DESC');


      if(isset($input['max_sidebar_filter']) && isset($input['min_sidebar_filter'])){

         $sellerProducts  = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                        ->where('seller_id',$sellers['id'])
                                        ->whereBetween('main_price', [$input['min_sidebar_filter'],$input['max_sidebar_filter']])
                                        ->orderBy('id','DESC');
      }        

      $sellerProductsCategoryCount = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                          ->where('seller_id',$sellers['id'])
                                          ->distinct('category_id')
                                          ->pluck('category_id');
      // dd($sellers);

      $allCategories = SellerCategory::whereIn('id',$sellerProductsCategoryCount)->get();

      $product_name  = '';

      $category_id  = '';

      if(isset($_GET)){

           $category_id   = @$_GET['category_id'];

           $product_name  = @$_GET['product_name'];

           // dd($category_id,$product_name);

           if($category_id!=''){
                if($category_id!=0){
                    $sellerProducts = $sellerProducts->wherehas('sellerCategory',function($q) 
                       use($category_id){
                          $q->where('id',$category_id);
                       });
                }
           }

           if($product_name!=''){
               $sellerProducts = $sellerProducts->where(function($q) use($product_name){
                              $q->where('seller_products.name','LIKE','%'.$product_name.'%');
                   });
           }
           $sellerProducts       = $sellerProducts->paginate(8);

      }else{
        $sellerProducts          = $sellerProducts->paginate(8);
      }
      
      return view('frontend.index',compact('sellerProducts','slug','sellerProductsCategoryCount','allCategories'));

   }

   public function getCategoryWiseDetail(Request $request)

   {
       try {
            $data = [];
            $payload   = $request->all();
            // dd($payload);
            $sellers   = Seller::with('buisnessCategory')
                                ->where('slug',$payload['slug'])
                                ->first();

            $sellerProductsQ  = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory')

                                            ->where('seller_id',$sellers['id']);

                                            if($payload['max'] && $payload['min']){
                                                $sellerProductsQ->whereBetween('main_price', [$payload['min'],$payload['max']]);
                                            }
            if($payload['categoryId']==0){
                $sellerProducts  =  $sellerProductsQ->paginate(env('PAGINATION')?env('PAGINATION'): 10);
            }else{
                $sellerProducts  =  $sellerProductsQ->where('category_id',$payload['categoryId'])
                                            ->orderBy('id','DESC')
                                            ->paginate(env('PAGINATION')?env('PAGINATION'): 10);

            }                                


            $data['html'] = view('frontend.element.categoryWiseProduct', ['sellerProducts'=>$sellerProducts,'sellerProducts' => $sellerProducts,'slug'=>$payload['slug'],'selectedStorageView'=>$payload['selectedStorageView']])->render();

           

            $data['htmlForPages'] = '<p>Showing  '.$sellerProducts->currentPage().' –  '.$sellerProducts->count().' of '.$sellerProducts->count() .' results</p>';


            return json_encode($data);

            

       } catch (Exception $e) {

           \Log::error($e->getMessage());

       }

   }



   public function productDetail(Request $request,$slug,$product_slug) { 

        if (Auth::check()) {
            $userId  = Auth::user()->id;
        } else{
           $userId   = @$_COOKIE['guestId'];
        }
        $sellers             = Seller::with('buisnessCategory')
                                    ->where('slug',$slug)
                                    ->first();

        $sellerProducts      = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory','sellerProductColors','sellerProductSizes')
                                          ->where('seller_id',$sellers['id'])
                                          ->where('product_slug',$product_slug)
                                          ->first();


         SellerProduct::where('seller_id',$sellers['id'])
                                          ->where('product_slug',$product_slug)
                                          ->update([
                                                'product_view_count' => $sellerProducts['product_view_count']+1
                                            ]);

        $otherSellerProducts  = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory','sellerProductColors','sellerProductSizes')
                                         ->where('seller_id',$sellers['id'])
                                         ->where('category_id',$sellerProducts['category_id'])
                                         ->where('product_slug','!=',$product_slug)        
                                         ->get();         

        // $userProductCartData =ProductCart::where('user_id',$userId)
        //                                 ->where('product_id',$sellerProducts['id'])
        //                                 // ->pluck('product_id','product_quantity');
        //                                 ->get();
        // dd($userProductCartData);

        $usedProductQuan = ProductCart::where('user_id',$userId)
                                        ->where('product_id',$sellerProducts['id'])
                                        ->pluck('product_quantity')
                                        ->first();

        $usedProductQuan = ($usedProductQuan) ? $usedProductQuan : 0;                                       
        return view('frontend.product-details',compact('sellerProducts','otherSellerProducts','slug','userId','usedProductQuan'));
   }

   public function addProductAsCart(Request $request)
      {
          $data = $request->all(); 
          $response= [];
          $already_exist = ProductCart::where('user_id',$data['userId'])
                                          ->where('product_id',$data['productId'])
                                          ->first();

            if(!empty($already_exist)){
                $response['status'] = 'false';
                $response['msg']    = 'Product already exist in cart.';
            }else{
                $data['userId'];
                $findProductAlreadyExist = ProductCart::where('user_id',$data['userId'])
                                                    ->where('product_id',$data['productId'])
                                                    ->first();
                if($findProductAlreadyExist){
                    $productDetail  = SellerProduct::where('id',$data['productId'])->first();
                    $price          = ($productDetail['discounted_price']) ? $productDetail['discounted_price']:$productDetail['price'];
                    $totalPrice     = $price*$data['quantity'];

                    ProductCart::where('id',$findProductAlreadyExist['id'])->update([

                          'product_quantity'             =>@$data['quantity'],

                          'product_quantity_price'       =>@$price,

                          'product_name'                 =>@$productDetail['name'],

                          'total_price'                  =>@$totalPrice

                    ]);

                                

                }else{

                    $productCartId      =  ProductCart::create([

                                                    'user_id'                =>$data['userId'],

                                                    'product_id'             =>$data['productId']

                                                ])->id;

                    

                    $productDetail      = SellerProduct::where('id',$data['productId'])->first();

                    $price = ($productDetail['discounted_price']) ? $productDetail['discounted_price']:$productDetail['price'];

                    $totalPrice = $price*$data['quantity'];

                    ProductCart::where('id',$productCartId)->update([

                          'product_quantity'             =>@$data['quantity'],

                          'product_quantity_price'       =>@$totalPrice,

                          'product_name'                 =>@$productDetail['name'],

                          'total_price'                  =>@$totalPrice

                    ]);

                }                                                       



                $card_type_item_count = ProductCart::where('user_id',$data['userId'])->count();

                $response['count']  =  $card_type_item_count;    

                $response['status'] = 'true';

                $response['msg']    = 'Product successfully added in Cart';

          }

          return $response;

       }



    public function addProductDescriptiopnCart(Request $request)
        {
            $data = $request->all(); 
            $response = [];
            // dd($data);
            if(empty($data['quantity'])){ 
                $response['status'] = 'false';
                $response['msg']    = 'please select quantity';
               return $response; 
            }

            if(isset($data['product_size'])){
                $already_exist = ProductCart::where('user_id',$data['userId'])
                                              ->where('product_id',$data['productId'])
                                              ->where('size_id',$data['product_size'])
                                              ->first();
                if($already_exist){
                    $productDetail  = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                                    ->where('id',$data['productId'])
                                                    ->first();

                    $productSize = SellerProductSize::where('id',$data['product_size'])
                                                    ->where('product_id',$productDetail['id'])
                                                    ->first();

                    $price = ($productSize['discount_price']) ? $productSize['discount_price']:$productSize['size_price'];
                    
                    $totalPrice                         = $price*$data['quantity'];
                    $product                            = ProductCart::find($already_exist['id']);
                    $product->product_quantity         += @$data['quantity'];
                    $product->product_quantity_price    = @$price;
                    $product->product_name              = @$productDetail['name'];
                    $product->size_id                   = @$productSize['id'];
                    // $product->color_id                  = @$data['product_color'];
                    $product->total_price              += @$totalPrice;
                    $product->update();

                    $card_type_item_count = ProductCart::where('user_id',$data['userId'])->count();

                    $response['count']  =  $card_type_item_count;    

                    $response['status'] = 'true';

                    $response['msg']    = 'Product successfully added in Cart';

                }else{

                    $productCartId      =  ProductCart::create([
                                                'user_id'                =>$data['userId'],
                                                'product_id'             =>$data['productId'],
                                                'size_id'                =>@$data['product_size']
                                                // 'color_id'               =>@$data['product_color']
                                            ])->id;

                    $productDetail      = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory')->where('id',$data['productId'])->first();

                    // SellerProductColor
                    $productSize = SellerProductSize::where('id',$data['product_size'])
                                                    ->where('product_id',$productDetail['id'])
                                                    ->first();

                    $price = ($productSize['discount_price']) ? $productSize['discount_price']:$productSize['size_price'];
                    $totalPrice = $price*$data['quantity'];

                    ProductCart::where('id',$productCartId)->update([
                      'product_quantity'             =>@$data['quantity'],
                      'product_quantity_price'       =>@$price,
                      'product_name'                 =>@$productDetail['name'],
                      'total_price'                  =>$totalPrice
                    ]);


                    $card_type_item_count = ProductCart::where('user_id',$data['userId'])->count();
                    $response['count']  =  $card_type_item_count;    
                    $response['status'] = 'true';
                    $response['msg']    = 'Product successfully added in Cart';
                }
                return $response; 

               
            }else{
                $already_exist = ProductCart::where('user_id',$data['userId'])
                                              ->where('product_id',$data['productId'])
                                              ->first();
                if($already_exist){
                    $productDetail  = SellerProduct::where('id',$data['productId'])->first();
                   
                    $price = ($productDetail['discounted_price']) ? $productDetail['discounted_price']:$productDetail['price'];
                    $totalPrice                         = $price*$data['quantity'];
                    $product                            = ProductCart::find($already_exist['id']);
                    $product->product_quantity         += @$data['quantity'];
                    $product->product_quantity_price    = @$price;
                    $product->product_name              = @$productDetail['name'];
                    $product->total_price              += @$totalPrice;
                    // $product->color_id                  = @$data['product_color'];

                    $product->update();
                    $card_type_item_count = ProductCart::where('user_id',$data['userId'])->count();
                    $response['count']  =  $card_type_item_count;    
                    $response['status'] = 'true';
                    $response['msg']    = 'Product successfully added in Cart';
                    return $response; 
                }else{

                    $productCartId      =  ProductCart::create([
                                                'user_id'                =>$data['userId'],
                                                'product_id'             =>$data['productId']
                                            ])->id;

                    $productDetail      = SellerProduct::where('id',$data['productId'])->first();

                    $price = ($productDetail['discounted_price']) ? $productDetail['discounted_price']:$productDetail['price'];

                    $totalPrice = $price*$data['quantity'];

                    ProductCart::where('id',$productCartId)
                                ->update([
                                          'product_quantity'             =>@$data['quantity'],
                                          'product_quantity_price'       =>@$price,
                                          'product_name'                 =>@$productDetail['name'],
                                          'total_price'                  =>@$totalPrice
                                          // 'color_id'                     =>@$data['product_color']
                        ]);

                    $card_type_item_count = ProductCart::where('user_id',$data['userId'])->count();
                    $response['count']  =  $card_type_item_count;    
                    $response['status'] = 'true';
                    $response['msg']    = 'Product successfully added in Cart';
                }

                return $response; 
            }

            return $response; 
        }


    public function deleteCartItem(Request $request,$slug,$productCartId) { 

        $productCart = ProductCart::where('id',$productCartId)
                        ->delete();

        // Session::forget('discount_price');

        Session::forget('discounted_Amount');

        Session::forget('discount_price');

        Session::forget('discount_type');

        Session::forget('coupon_name');



        if($productCart){

            return redirect('/'.$slug.'/'.'view-cart-detail')->with(session::flash('success', "Product deleted from cart  successfully"));

        }else{

            return redirect('/'.$slug.'/'.'view-cart-detail')->with(session::flash('error', "Something went wrong"));

        }                

    }



    public function cartDetail(Request $request,$slug) { 

        if (Auth::check()) {
            $userId  = Auth::user()->id;
        } else{
           $userId   = @$_COOKIE['guestId'];
        }

        $item_count      = ProductCart::where('user_id',$userId)->count();
        $pluckProduct    = ProductCart::where('user_id',$userId)->pluck('product_id');

        // $sellerProduct   = SellerProduct::whereIn('id',$pluckProduct)
        //                             ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
        //                             ->get();

        $sellerProduct = ProductCart::with('Product.sellerProductColors','Product.sellerProductSizes','Product.sellerInfo','Product.sellerProductImages','Product.sellerUnit','Product.sellerCategory')->where('user_id',$userId)->whereIn('product_id',$pluckProduct)->get();
                                    
                                    
        $sumProductPrice = ProductCart::where('user_id',$userId)->sum('total_price');    
        return view('frontend.cart',compact('sellerProduct','sumProductPrice','slug'));
    }


    public function checkCouponApply(Request $request)

       {

            $data = $request->all();

            // dd($data); 

            $response= [];

            $checkDiscountCoupon=SellerDiscountCoupon::where('coupon_code',$data['coupon_name'])->first();

            

            // dd($data);

            if($checkDiscountCoupon){

                if($checkDiscountCoupon['uses_per_count']>0){

                    if($checkDiscountCoupon['discount_type']=='percent'){

                        if (Auth::check()) {

                            $userId   = Auth::user()->id;

                        } else{

                            $userId   = @$_COOKIE['guestId'];

                        }

                        $sumProductPrice = ProductCart::where('user_id',$userId)->sum('total_price');  

                        if($checkDiscountCoupon['min_order_amount'] < $sumProductPrice){

                            $percentPrice = ($checkDiscountCoupon['percent'] / 100) * $sumProductPrice;

                            // dd($percentPrice);   

                            $discountType ='percent';

                            Session::put('discount_type', $discountType);

                            Session::put('coupon_name', $checkDiscountCoupon['coupon_code']);



                            if($percentPrice >$checkDiscountCoupon['maximum_discount']){

                                $response['discount_price']  =  $checkDiscountCoupon['maximum_discount'];

                                Session::put('discounted_Amount', $response['discount_price']);

                                $finalPriceAfterPercentDiscount = $sumProductPrice - $response['discount_price'];

                                Session::put('discount_price', $finalPriceAfterPercentDiscount);

                                $response['status'] = 'true';

                                $response['msg']    = 'Coupon applied successfully';

                            }else{

                                $response['discount_price']  =  $percentPrice;   

                                Session::put('discounted_Amount', $response['discount_price']);

                                 $finalPriceAfterPercentDiscount = $sumProductPrice - $response['discount_price'];

                                Session::put('discount_price', $finalPriceAfterPercentDiscount);

                                $response['status'] = 'true';

                                $response['msg']    = 'Coupon applied successfully';

                            }

                        }else{

                            Session::forget('discounted_Amount');

                            Session::forget('discount_price');

                            Session::forget('discount_type');

                            Session::forget('coupon_name');



                            $response['status'] = 'false';

                            $response['msg']    = 'Coupon will not apply,because minimum amount greater than order amount';          

                        }



                    }else{

                        //flat_discount

                        if (Auth::check()) {

                            $userId   = Auth::user()->id;

                        } else{

                            $userId   = @$_COOKIE['guestId'];

                        }

                        

                        $sumProductPrice = ProductCart::where('user_id',$userId)->sum('total_price');  

                        if($sumProductPrice > $checkDiscountCoupon['minimum_order_amount']){

                            $finalAmountAfterDiscount    = $sumProductPrice -  $checkDiscountCoupon['discount_amount'];

                            $discountType ='flat_discount';

                            Session::put('coupon_name', $checkDiscountCoupon['coupon_code']);

                            Session::put('discount_type', $discountType);

                            Session::put('discounted_Amount', $checkDiscountCoupon['discount_amount']);

                            $response['discount_price']  =  $finalAmountAfterDiscount;

                            Session::put('discount_price', $response['discount_price']);

                            $response['status'] = 'true';

                            $response['msg']    = 'Coupon applied successfully';

                        }else{

                            Session::forget('discounted_Amount');

                            Session::forget('discount_price');

                            Session::forget('discount_type');

                            Session::forget('coupon_name');

                            $response['status'] = 'false';

                            $response['msg']    = 'Coupon will not apply,because minimum amount greater than order amount'; 

                        }

                    }    

                }else{

                    Session::forget('discounted_Amount');

                    Session::forget('discount_price');

                    Session::forget('discount_type');

                    Session::forget('coupon_name');





                    $response['status'] = 'false';

                    $response['msg']    = 'Coupon limit end';          

                }



            }else{

                Session::forget('discounted_Amount');

                Session::forget('discount_price');

                Session::forget('discount_type');

                Session::forget('coupon_name');

                $response['status'] = 'false';

                $response['msg']    = 'Coupon Not exist'; 

            }



            $view1 = view('frontend.element.cartDetail',['slug'=>$data['slug']])->render();

            $view2 = view('frontend.element.headerElement',['slug'=>$data['slug']])->render();

            $view    = array('renderData'=>$view1,'renderData2'=>$view2,'response'=>$response);

            return json_encode($view); 

       }





    public function updateCartDetail(Request $request){

        $data = $request->all();

        $myArray = json_decode(stripcslashes($data['myarray']));

        $response= [];

        foreach ($myArray as $key => $value) {
            $firstRecord = ProductCart::where('product_id',$key)->first();
            $price = $firstRecord['product_quantity_price']*$value;
            ProductCart::where('product_id',$key)->update([
                                        'product_quantity'  => $value,
                                        'total_price'       => $price
                                ]);
        }
        $response['userId'] =  1;

        $response['status'] = 'true';

        $response['msg']    = 'Cart updated successfully';      



        return $response; 

    }


    public function getShipQuotes()
    {
        $temp_token = "YaL96UnsIzZR0B859IwboW1GanUFkfHoKd0QRHC4qmiJyBlJ3oyxSBKt1Okp";
        $headers = [
            "Authorization" => "Bearer " . $temp_token,
            "Cache-Control" => "no-cache",
            "Accept" => "application/json",
        ];
        $data = array (
            'address_from' => 
                    array (
                    'name' => 'Nombre de Remitente',
                    'phone' => '5555555555',
                    'email' => 'mail@example.com',
                    'zipcode' => '56356',
                    'country' => 'MX',
                    'street' => 'Av. Principal 34',
                    'street2' => 'Col centro.',
                    'alias' => 'Alias de la dirección',
                    'object_type' => 'PURCHASE',
                    ),
            'address_to' => 
                    array (
                    'name' => 'Nombre de Destinatario',
                    'phone' => '2222222222',
                    'email' => 'mail@example.com',
                    'zipcode' => '62736',
                    'country' => 'MX',
                    'street' => 'Calle Quetzal 9',
                    'street2' => 'Colonia bella',
                    'alias' => 'Alias de la dirección',
                    'object_type' => 'PURCHASE',
                    ),
            'quote' => 
                array (
                    'items' => 
                            array ( 
                                array (
                                'declared_value' => 5000,
                                'height' => 2,
                                'id' => 'id-1',
                                'length' => 2,
                                'qty' => 1,
                                'weight' => 3.22,
                                'width' => 2,
                                ),
                                array (
                                'declared_value' => 2500,
                                'height' => 2,
                                'id' => 'id-2',
                                'length' => 15,
                                'qty' => 1,
                                'weight' => 1,
                                'width' => 13,
                                ),
                            ),
                    'object_purpose' => 'QUOTE',
                ),
        );
        $g_uri = "https://dev-sandbox.mienvio.mx/";
        
        $client = new \GuzzleHttp\Client();
        $response = $client->post("https://dev-sandbox.mienvio.mx/api/quoteShipment" ,[
            'headers' => $headers,
            'json' => $data,
        ]);
        $result =  $response->getBody()->getContents();        
        return $result;
    }

    public function cartCheckout(Request $request,$slug) { 
    
        if (Auth::check()) {
            $userId  = Auth::user()->id;
        } else{
           $userId   = @$_COOKIE['guestId'];
        }

        $defaultAddress = UserAddress::where('user_id',$userId)->where('use_address_as_default','yes')->first();


        $item_count      = ProductCart::where('user_id',$userId)->count();

        $pluckProduct    = ProductCart::where('user_id',$userId)->pluck('product_id');

        // $sellerProduct   = SellerProduct::whereIn('id',$pluckProduct)
        //                             ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
        //                             ->get();

        $sellerProduct = ProductCart::with('Product.sellerProductColors','Product.sellerProductSizes','Product.sellerInfo','Product.sellerProductImages','Product.sellerUnit','Product.sellerCategory')->where('user_id',$userId)->whereIn('product_id',$pluckProduct)->get();
        
        $sumProductPrice = ProductCart::where('user_id',$userId)->sum('total_price');

        $seller = Seller::where('slug',$slug)->first();

        $cartProduct = ProductCart::with('Product.sellerProductColors','Product.sellerProductSizes','Product.sellerInfo','Product.sellerProductImages','Product.sellerUnit','Product.sellerCategory')->where('user_id',$userId)->whereIn('product_id',$pluckProduct)->get()->toArray();
        $shipItems = array();
        foreach($cartProduct as $pp){        
            $shipItems[] = array(
                            'declared_value' => $pp['total_price'],
                            'height' => $pp['product']['height'],
                            'id' => $pp['id'],
                            'length' => $pp['product']['length'],
                            'qty' => $pp['product_quantity'],
                            'weight' => $pp['product']['weight'],
                            'width' => $pp['product']['width'],                        
                        );
        }
        
        $address_from = array(
            'name' => $seller->buisness_name,
            'phone' => $seller->mobile_number,
            'email' => $seller->email,
            'zipcode' => $seller->zipcode,
            'country' => 'MX',
            'street' => $seller->street,
            'street2' => $seller->street2,
            'alias' => $seller->alias,
            'object_type' => 'PURCHASE',                
        );
        if($defaultAddress){
            $address_to = array(
                'name' => $defaultAddress->name,
                'phone' => $defaultAddress->mobile_number,
                'email' => Auth::user()->email,
                'zipcode' => $defaultAddress->pincode,
                'country' => $defaultAddress->isd_flag,
                'street' => $defaultAddress->street,
                'street2' => $defaultAddress->street2,
                'alias' => Auth::user()->alias,
                'object_type' => 'PURCHASE',                
            );                
        }else{
            $address_to = array();
        }

        
        $storeSetting = SellerAdditionalInformation::where('seller_id',$seller['id'])->get();
        return view('frontend.checkout',compact('sellerProduct','sumProductPrice','slug','userId','defaultAddress','storeSetting'));

    }



    public function setDefualtAddress(Request $request) {

        

        if($request->isMethod('post')){

            $data = $request->all();

            $decAddressId = $request->address_id;

            

            $updateDeliveryAddress = UserAddress::where('id',$decAddressId)

                                            ->update(['use_address_as_default'=>'yes']);



            $updateOtherDeliveryAddresses = UserAddress::where('id','<>',$decAddressId)

                                                       ->where('user_id',Auth::user()->id)

                                                       ->update(['use_address_as_default'=>'no']);

                                                       

            if (!empty($updateDeliveryAddress) && $updateDeliveryAddress!=null) {

                Session::flash('success',trans('Address set as default'));

                return redirect('/'.$data['slug'].'/my-addresses');

            }else{

                Session::flash('error',trans('Something went wrong'));

                return redirect()->back();

            }

            

        }

    }



    public function getPrivacyPolicy(Request $request,$slug){

        $pivacyPolicies = PrivacyPolicy::first();

        return view('frontend.privacy-policy',compact('pivacyPolicies','slug'));

    } 



    public function getTermAndCondtion(Request $request,$slug){
        $termAndCondtions = TermAndCondtion::first();
        return view('frontend.terms-conditions',compact('termAndCondtions','slug'));
    } 

    public function getShippingQuotes(Request $request)
    {
        $temp_token = "YaL96UnsIzZR0B859IwboW1GanUFkfHoKd0QRHC4qmiJyBlJ3oyxSBKt1Okp";
        $headers = [
            "Authorization" => "Bearer " . $temp_token,
            "Cache-Control" => "no-cache",
            "Accept" => "application/json",
        ];
        $data = array (
            'address_from' => 
                    array (
                    'name' => 'Nombre de Remitente',
                    'phone' => '5555555555',
                    'email' => 'mail@example.com',
                    'zipcode' => '56356',
                    'country' => 'MX',
                    'street' => 'Av. Principal 34',
                    'street2' => 'Col centro.',
                    'alias' => 'Alias de la dirección',
                    'object_type' => 'PURCHASE',
                    ),
            'address_to' => 
                    array (
                    'name' => 'Nombre de Destinatario',
                    'phone' => '2222222222',
                    'email' => 'mail@example.com',
                    'zipcode' => '62736',
                    'country' => 'MX',
                    'street' => 'Calle Quetzal 9',
                    'street2' => 'Colonia bella',
                    'alias' => 'Alias de la dirección',
                    'object_type' => 'PURCHASE',
                    ),
            'quote' => 
                array (
                    'items' => 
                            array ( 
                                array (
                                'declared_value' => 5000,
                                'height' => 2,
                                'id' => 'id-1',
                                'length' => 2,
                                'qty' => 1,
                                'weight' => 3.22,
                                'width' => 2,
                                ),
                                array (
                                'declared_value' => 2500,
                                'height' => 2,
                                'id' => 'id-2',
                                'length' => 15,
                                'qty' => 1,
                                'weight' => 1,
                                'width' => 13,
                                ),
                            ),
                    'object_purpose' => 'QUOTE',
                ),
        );
        $g_uri = "https://dev-sandbox.mienvio.mx/";
        
        $client = new \GuzzleHttp\Client();
        $response = $client->post("https://dev-sandbox.mienvio.mx/api/quoteShipment" ,[
            'headers' => $headers,
            'json' => $data,
        ]);
        $result =  $response->getBody()->getContents();        
        return $result;
    }

}

