<?php

namespace App\Http\Controllers\frontend\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use IlluminateHttpRequest;
use AppHttpRequestsRegisterAuthRequest;
use TymonJWTAuthExceptionsJWTException;
use SymfonyComponentHttpFoundationResponse;
use Illuminate\Http\Response;
use Mail, Hash, Auth;
use App\Models\BuisnessCategory;
use App\Models\Seller;
use App\Models\SellerCategory;
use App\Models\SellerImage;
use App\Models\SellerProduct;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Traits\ImagesTrait;
use App\Models\SellerProductColor;
use App\Models\SellerProductSize;
use App\Models\SellerDiscountCoupon;
use App\Models\SellerAdditionalInformation;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth; 
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Order;
use App\Models\ordersDetail;
use App\Models\OrderAddress;
use App\Models\Page;
use App\Models\SellerExtraCharge;
use App\Models\SellerGstCharge;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Session;
use Validator;
use DB;
use Twilio\Rest\Client;
use Carbon\Carbon;
use App\Models\StoreSetting;
use App\Models\StoreSettingsNew;
use Image; //Intervention Image
use Illuminate\Support\Facades\Storage; //Laravel Filesystem

class ApiController extends Controller
{
    use ImagesTrait;
    public function seller_registration(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'mobile_number'     => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 200);
        }

        // $twillio                 = $this->sendMessage('User registration successful!!', "+919855607503");
        $six_digit_random_number = 123456;
        
        // $six_digit_random_number = $twillio['otp'];
        // $six_digit_random_number = random_int(100000, 999999);

        // $six_digit_random_number = random_int(100000, 999999);
        
        $check_seller_mobile_number_exist = Seller::where('mobile_number', $input['mobile_number'])->first();
        if ($check_seller_mobile_number_exist) {
            Seller::where('mobile_number', $input['mobile_number'])
                            ->update([
                               'otp' => $six_digit_random_number
                            ]);
            return response()->json(['status' => true,'code'=>200,'message' => 'Registration successfully','otp'=>$six_digit_random_number,'mobile_number'=>$input['mobile_number']], Response::HTTP_OK);
        }

       $sellerCreation =  Seller::create([
                            'mobile_number'  => $input['mobile_number'],
                            'otp'            => $six_digit_random_number
                            ]);
       if($sellerCreation){
            return response()->json(['status' => true,'code'=>200,'message' => 'Registration successfully','otp'=>$six_digit_random_number,'mobile_number'=>$input['mobile_number']], Response::HTTP_OK);
       }else{
            return response()->json(['error' => false,'message' => 'Something went wrong, Please try again later.', 'code' => 400]);
       }
    }

    private function sendMessage($message, $recipients)
    {
       $from_number  = '+19038475511';
       $client = new Client('AC157522dd177232692e6fbbcd5fe5f172','3367fe4ef9e8a216b7b60effc6899f4c');
       // dd($client);
       $otp = random_int(100000, 999999);
       $phone_number = '+919855607503';

       $otp_message = $otp;
           try{
               $sms = $client->messages->create(
                   '+'.$phone_number,
                   array(
                    'from' => $from_number,
                    'body' => $otp
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
           // dd($data);
        return $data;
    }

    public function resendVerificationCode(Request $request){
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
                'mobile_number'     => 'required|numeric'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 200);
        }

        // $six_digit_random_number = random_int(100000, 999999);
        $six_digit_random_number = 123456;
        
        // $twillio                 = $this->sendMessage('User registration successful!!', "+919855607503");
        // $six_digit_random_number = $twillio['otp'];
        // $six_digit_random_number = random_int(100000, 999999);

        $check_seller_mobile_number_exist = Seller::where('mobile_number', $input['mobile_number'])->first();
        
        if ($check_seller_mobile_number_exist) {
            Seller::where('mobile_number', $input['mobile_number'])
                            ->update([
                               'otp' => $six_digit_random_number
                            ]);
            return response()->json(['status' => true,'code'=>200,'message' => 'Code resend successfully','otp'=>$six_digit_random_number,'mobile_number'=>$input['mobile_number']], Response::HTTP_OK);
        }
    }

    public function otp_verification(Request $request)
       {
            // $credentials = $request->only('mobile_number', 'otp');
            $credentials = request(['mobile_number', 'otp']);
            $validator = Validator::make(
               $request->all(),
               [
                   'mobile_number'     => 'required|numeric',
                   'otp'               => 'required|numeric'
               ]
            );

            if($validator->fails()) {
               return response()->json(['error' => $validator->errors()], 200);
            }

            $check_seller_otp_exist = Seller::where('mobile_number', $credentials['mobile_number'])
                                                ->where('otp', $credentials['otp'])
                                                ->first();
            // dd($check_seller_otp_exist);                                                          
            if($check_seller_otp_exist) {      
               $userToken = auth('api')->tokenById($check_seller_otp_exist['id']);

                return response()->json(['status' => true,'message' => 'Seller login successfuly','token'=>$userToken,'sellerInformation'=>$check_seller_otp_exist,'code' => 200]);
            }else{
                return response()->json(['status' => false,'message' => 'Invalid otp and password', 'code' => 400]);
            }
       }

    public function getSellerBuisnessDetail(Request $request)
    {
        $input              = $request->all();
        $buisnessCategories = DB::table('buisness_categories')->get();
        // dd($buisnessCategories);
        $sellerInformation  = Auth::guard('api')->user();
        return response()->json(['status' => true,'message' => 'Get Seller buisness information','seller_information'=>$sellerInformation,'buisnessCategories'=>$buisnessCategories,'code' => 200]);
    }

    // public function updateSellerBuisnessDetail(Request $request)
    // {
    //     $input = $request->all();
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //            'buisness_name'        =>'required',
    //            'buisness_category_id' =>'required'
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         $response['code'] = 404;
    //         $response['status'] = $validator->errors()->first();
    //          $response['message'] = "missing parameters";
    //         return response()->json($response);
    //     }

    //     $sellerInformation  = Auth::guard('api')->user();
    //     // print_r($sellerInformation); die();
        
    //     if(empty($sellerInformation['slug']) && empty($sellerInformation['buisness_name']) && empty($sellerInformation['buisness_category_id']) ){
            
    //         $updateSellerslug  = Seller::where('mobile_number', $sellerInformation['mobile_number'])
    //                                 ->update([
    //                                     'slug'                  => str_slug($input['buisness_name']).$sellerInformation['id'],
    //                                     'buisness_name'         => $input['buisness_name'],
    //                                     'buisness_category_id'  => $input['buisness_category_id'],
    //                                     'verified_status'       => 'verified'
    //                                 ]);

    //         return response()->json(['status' => true,'message' => 'Updated Seller buisness information successfully','code' => 200]);
    //     }

    //     if(isset($input['buisness_name']) || isset($input['buisness_category_id'])){
    //         $updateSellerInformation  = Seller::where('mobile_number', $sellerInformation['mobile_number'])
    //                                     ->update([
    //                                         'buisness_name'         => @$input['buisness_name'],
    //                                         'buisness_category_id'  => @$input['buisness_category_id'],
    //                                         'verified_status'       => 'verified'
    //                                     ]);
    //         return response()->json(['status' => true,'message' => 'Updated Seller buisness information','code' => 200]);
    //     }
    //     return response()->json(['status' => true,'message' => 'Updated Seller buisness information','seller_information'=>$sellerInformation,'code' => 200]);
    // }

    public function updateSellerBuisnessDetail(Request $request){

        $input = $request->all();
        $validator = Validator::make(
                  $request->all(),
                  [
                     'buisness_name'        =>'required',
                     'buisness_category_id' =>'required'
                  ]
              );

              if ($validator->fails()) {
                  $response['code'] = 404;
                  $response['status'] = $validator->errors()->first();
                   $response['message'] = "missing parameters";
                  return response()->json($response);
              }

        $sellerInformation  = Auth::guard('api')->user();
        if(empty($sellerInformation['slug']) && empty($sellerInformation['buisness_name']) && empty($sellerInformation['buisness_category_id']) ){          

            $updateSellerslug  = Seller::where('mobile_number', $sellerInformation['mobile_number'])
                                      ->update([
                                          'slug'                  => str_slug($input['buisness_name']).$sellerInformation['id'],
                                          'buisness_name'         => $input['buisness_name'],
                                          'buisness_category_id'  => $input['buisness_category_id'],
                                          'verified_status'       => 'verified'
                                      ]);

            return response()->json(['status' => true,'message' => 'Updated Seller buisness information successfully','code' => 200]);
        }

          
        $image = isset($input['store_image']) && !empty($input['store_image']) ? $input['store_image']:'';  
          
        if(isset($input['store_image'])){
            if($image){ 
                $directory = 'frontend/assets/img/sellerImage';
                $type = 'logo';
                $imagedata = $this->uploadimage($directory,$type, $image, '');
                  if(isset($imagedata) && $imagedata != ''){
                      // dd($imagedata);
                      $image = $imagedata['image'];
                  }
              }
            if($input['store_image'] != null && file_exists('frontend/assets/img/sellerImage'.'/'.$input['store_image']) ) {
                unlink('frontend/assets/img/sellerImage'.'/'.$input['store_image']);
            }
        }

        $sellerUrl = url('/').'/'.$sellerInformation['slug'];

        Seller::where('mobile_number', $sellerInformation['mobile_number'])->update([
                              // 'slug'                  => str_slug($input['buisness_name']).$sellerInformation['id'],
                              'buisness_name'         => $input['buisness_name'],
                              'buisness_category_id'  => $input['buisness_category_id'],
                              'verified_status'       => 'verified',
                              'store_url'             => @$sellerUrl,
                              'store_address'         => @$input['store_address'],
                              'store_image'           => @$image
                          ]);

        return response()->json(['status' => true,'message' => 'Seller information updated successfully','code' => 200]);
    }

    public function getDashboardDetail(Request $request)
    {
        $input = $request->all();
        $buisnessCategories = BuisnessCategory::orderBy('id','DESC')->get();
        $sellerInformation  = Auth::guard('api')->user();

        //$OrderCount  = 0;
        $totalSale     = 0;                                          
        
        $acceptedOrder = 0;
        $pendingOrder  = 0;                                        
        $shippedOrder  = 0;                                        

        $urlShare = url('/').'/'.$sellerInformation['slug'];

        $orderCount = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                    ->where('seller_id',$sellerInformation['id'])
                    ->count();

        $sellerProductsCount = SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                            ->where('seller_id',$sellerInformation['id'])
                                            ->sum('product_view_count');

        return response()->json(['status' => true,'message' => 'Get dashboard information','sellerProductsCount'=>$sellerProductsCount,'urlShare'=>$urlShare,'OrderCount'=>$orderCount,'totalSale'=>$totalSale,'acceptedOrder'=>$acceptedOrder,'pendingOrder'=>$pendingOrder,'shippedOrder'=>$shippedOrder,'seller_information'=>$sellerInformation,'code' => 200]);
    }
    
    public function getProductCategories(Request $request)
    {
        $input = $request->all();
        $sellerInformation  = Auth::guard('api')->user();

        $sellerCategories = SellerCategory::withCount('sellerProducts')->where('seller_id',$sellerInformation['id'])->orderBy('id','DESC')->get();
        if($sellerCategories){
            return response()->json(['status' => true,'message' => 'Get product seller category list','sellerCategories'=>$sellerCategories,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No category found', 'code' => 400]);
        }
    }

    
    public function getProductCategoriesDetail(Request $request,$category_id)
    {
        $input = $request->all();
        $sellerInformation  = Auth::guard('api')->user();

        $sellerProduct   = SellerProduct::where('category_id',$category_id)
                                        ->where('seller_id',$sellerInformation['id'])
                                        ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
                                        ->get(); 
        $sellerCategory = SellerCategory::find($category_id);
        if($sellerCategory){
            return response()->json(['status' => true,'message' => 'Get category details','sellerCategory'=>$sellerCategory,'categoryProducts'=>$sellerProduct,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No category found', 'code' => 400]);
        }
    }

 

    public function addProductCategories(Request $request)
    {
        $input = $request->all();
        // return response()->json(['All Data' => $input]);
        $validator = Validator::make(
            $request->all(),
            [
               'name'        =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }

        // print_r($input['image']);die();
        $image = isset($input['image']) && !empty($input['image']) ? $input['image']:'';  
        if(isset($input['image'])){
            if($image){ 
              $directory = 'frontend/assets/img/productCategoryImage';
              $type = 'logo';
              $imagedata = $this->uploadimage($directory,$type, $image, '');
                if(isset($imagedata) && $imagedata != ''){
                    $image = $imagedata['image'];
                }
            }
            if($input['image'] != null && file_exists('frontend/assets/img/productCategoryImage'.'/'.$input['image']) ) {
                unlink('frontend/assets/img/productCategoryImage'.'/'.$input['image']);
            }
        }

        $sellerInformation  = Auth::guard('api')->user();
        SellerCategory::create([
                           'name'       => @$input['name'],
                           'seller_id'  => $sellerInformation['id'],                         
                           'image'      => @$image
                        ]);                                  

        $sellerCategories = SellerCategory::with('seller')
                                        ->where('seller_id',$sellerInformation['id'])
                                        ->get();
        if($sellerCategories){
            return response()->json(['status' => true,'message' => 'Seller categories added','sellerCategories'=>$sellerCategories,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No category found', 'code' => 400]);
        }
    }

    public function editProductCategories(Request $request,$category_id)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'name'        =>'required'
            ]
        );
        
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }
        
        $sellerInformation  = Auth::guard('api')->user();

        $sellerCategories = SellerCategory::with('seller')
                                        ->where('id',$category_id)
                                        ->first();

        $image = ($request->has('image') && !empty($input['image'])) ? $input['image']:'';  
        $old_image = $sellerCategories['image'];
        if($request->has('image')){
            if($image){ 
              $directory = 'frontend/assets/img/productCategoryImage';
              $type = 'logo';
              $imagedata = $this->uploadimage($directory,$type, $image, '');
                if(isset($imagedata) && $imagedata != ''){
                    $image = $imagedata['image'];
                }
            }
            if($old_image && file_exists('public/frontend/assets/img/productCategoryImage/'.$old_image)){
                unlink('public/frontend/assets/img/productCategoryImage/'.$old_image);    
            }
        }else{
            $image = $old_image;
        }


        $result = SellerCategory::where('id',$category_id)
                        ->update([
                           'name'       => @$input['name'],
                           'seller_id'  => $sellerInformation['id'],                         
                           'image'      => @$image
                        ]);                                  
             
        if($result){
            return response()->json(['status' => true,'message' => 'Seller product updated','sellerCategory'=>$result,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No category found', 'code' => 400]);
        }
    }

    public function deleteProductCategories($id){
        $SellerCategory = SellerCategory::where('id',$id)->first();
        if($SellerCategory){

            if ($SellerCategory['image'] && file_exists('public/frontend/assets/img/productCategoryImage/'.$SellerCategory['image'])){
                unlink('public/frontend/assets/img/productCategoryImage/'.$SellerCategory['image']);
            }

            SellerCategory::where('id', $id)->delete();
            return response()->json(['status' => true,'message' => 'Seller categories deleted sucessfully', 'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'Seller categories not found', 'code' => 400]);
        }
    } 

    public function getProducts(Request $request)
    {
        $input = $request->all();
        $sellerInformation  = Auth::guard('api')->user();

        $sellerProducts = SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')->where('seller_id',$sellerInformation['id'])->orderBy('id','DESC')->get();

        $sellerProductsCount = SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')->where('seller_id',$sellerInformation['id'])->sum('product_view_count');
        
        if($sellerProducts){
            return response()->json(['status' => true,'message' => 'Get products list','sellerProducts'=>$sellerProducts,'sellerProductsCount'=>$sellerProductsCount,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No product found', 'code' => 400]);
        }
    }

    public function changeStatusProduct(Request $request,$product_id)
        {
            $input = $request->all();
            $validator = Validator::make(
                $request->all(),
                [
                   'status'              =>'required'
                ]
            );
        
            if ($validator->fails()) {
                $response['code'] = 404;
                $response['status'] = $validator->errors()->first();
                 $response['message'] = "missing parameters";
                return response()->json($response);
            }        

            SellerProduct::where('id',$product_id)
                                         ->update(['status' =>@$input['status']]);

            $sellerProduct = SellerProduct::where('id',$product_id)
                                            ->first();

            if($sellerProduct){
                return response()->json(['status' => true,'message' => 'Product status change','sellerProduct'=>$sellerProduct,'code' => 200]);
            }else{
                return response()->json(['status' => false,'message' => 'Something went wrong', 'code' => 400]);
            }
        }

    public function changeStatusCategory(Request $request,$category_id)
        {
            $input = $request->all();
            $validator = Validator::make(
                $request->all(),
                [
                   'status'              =>'required'
                ]
            );
        
            if ($validator->fails()) {
                $response['code'] = 404;
                $response['status'] = $validator->errors()->first();
                 $response['message'] = "missing parameters";
                return response()->json($response);
            }        

            SellerCategory::where('id',$category_id)
                                         ->update([
                                                 'status'     =>@$input['status']
                                            ]);

            $SellerCategory = SellerCategory::where('id',$category_id)->first();

            if($SellerCategory){
                return response()->json(['status' => true,'message' => 'Product category status change','SellerCategoryList'=>$SellerCategory,'code' => 200]);
            }else{
                return response()->json(['status' => false,'message' => 'Something went wrong', 'code' => 400]);
            }
        }

    
    public function getProductDetail(Request $request,$product_id)
    {
        $input = $request->all();
        $sellerInformation  = Auth::guard('api')->user();

        $sellerProduct = SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','sellerProductSizes','sellerProductColors')
                                        ->where('seller_id',$sellerInformation['id'])
                                        ->where('id',$product_id)
                                        ->first();
        if($sellerProduct){
            return response()->json(['status' => true,'message' => 'Get product details','sellerProduct'=>$sellerProduct,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No product found', 'code' => 400]);
        }
    }

    public function addProduct(Request $request)
    {
        $input = $request->all();
        // print_r($input); die();
        // return response()->json(['status' => true,'message' => 'Product added','inputs'=>$input,'code' => 200]);

        $validator = Validator::make(
            $request->all(),
            [
               'name'                =>'required',
               'category_id'         =>'required',
               'price'               =>'required',
               'discounted_price'      =>'required',
               'quantity'            =>'required',
               'unit_id'             =>'required',
               'description'         =>'required',
               'weight'              =>'required',
               'length'              =>'required',
               'height'              =>'required',
               'width'               =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }

        $sellerInformation  = Auth::guard('api')->user();

        $slugGet = SellerProduct::where('name',$input['name'])->first();
        
        $slug = str_slug($input['name']);
        $oldslug = $slug;

        $count = 1;
        while (SellerProduct::where('product_slug',$slug)->exists()) {
            $slug = $oldslug.'-'.$count;
            $count++;   
        }
        $main_price = '';
        if($input['discounted_price']){
            $main_price = $input['discounted_price'];
        }else{
            $main_price = $input['price'];
        }

        $sellerProductId = SellerProduct::create([
                               'name'               => @$input['name'],
                               'seller_id'          => $sellerInformation['id'],                         
                               'category_id'        => @$input['category_id'],
                               'price'              => @$input['price'],
                               'discounted_price'   => @$input['discounted_price'],
                               'main_price'         => $main_price,
                               'quantity'           => @$input['quantity'],
                               'unit_id'            => @$input['unit_id'],
                               'description'        => @$input['description'],
                               'product_slug'       => @$slug,
                               'weight'             => @$input['weight'],
                               'length'             => @$input['length'],
                               'height'             => @$input['height'],
                               'width'              => @$input['width']
                        ])->id;      

            // print_r($input);
        if($request->has('images') && $input['images']){
            foreach($input['images'] as $key => $value) {
                $image = isset($value) && !empty($value) ? $value:'';  
                $imageThumbnail = isset($value) && !empty($value) ? $value:'';  
                if(isset($value)){
                    if($image){ 
                      $directory = 'frontend/assets/img/product';
                      $type = 'logo';
                      $imagedata = $this->uploadimage($directory,$type, $image, '');
                        if(isset($imagedata) && $imagedata != ''){
                            $image = $imagedata['image'];
                        }
                    }
                }
                $new_file = url('/').'/frontend/assets/img/product/'.$image; 
                // Thumbnail image
                if ($new_file) {
                    $profile = preg_replace('/\..+$/', '', $imageThumbnail->getClientOriginalName()).time().'.'.$imageThumbnail->getClientOriginalExtension();
                    $img_thmbnail = $this->resizeImage($new_file,$profile);
                }                
                SellerImage::create([
                           'product_id'  => $sellerProductId,                         
                           'image'       => @$image,
                           'thumbnail_image' => @$img_thmbnail
                        ]);      
            }
        }

        if(isset($input['colors'])){
            $input['colors'] = json_decode($input['colors'],true);
            foreach($input['colors'] as $key => $value1) {           
                SellerProductColor::create([
                       'seller_id'   =>  $sellerInformation['id'],
                       'product_id'  =>  $sellerProductId, 
                       'name'        =>  $value1['name'],                         
                       'color_code'  =>  $value1['color_code']                         

                    ]);      
            }
        }

        if(isset($input['sizes'])){
            $input['sizes'] = json_decode($input['sizes'],true);
            foreach($input['sizes'] as $key => $value2) {           
                SellerProductSize::create([
                    'seller_id'         =>  $sellerInformation['id'],
                    'product_id'        =>  $sellerProductId, 
                    'size'              =>  $value2['size'],                         
                    'size_price'        =>  $value2['price'],
                    'discount_price'    =>  $value2['discount_price'],
                    'quantity'          =>  $value2['quantity']
                ]);      
            }
        }

        $sellerProductAdded = SellerProduct::with('sellerProductColors','sellerProductSizes')
                                        ->where('seller_id',$sellerInformation['id'])
                                        ->where('id',$sellerProductId)
                                        ->first();

        if($sellerProductAdded){
            return response()->json(['status' => true,'message' => 'Product added','productAdded'=>$sellerProductAdded,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No Product found', 'code' => 400]);
        }
    }

    public function editProduct(Request $request,$id)
    {
        $payload = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'name'                =>'required',
               'category_id'         =>'required',
               'price'               =>'required',
               'discounted_price'    =>'required',
               'quantity'            =>'required',
               'unit_id'             =>'required',
               'description'         =>'required',
               'weight'              =>'required',
               'length'              =>'required',
               'height'              =>'required',
               'width'               =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }

        $sellerInformation  = Auth::guard('api')->user();

        $main_price = '';
        if($payload['discounted_price']){
            $main_price = $payload['discounted_price'];
        }else{
            $main_price = $payload['price'];
        }

        $sellerProductId = SellerProduct::where('id',$id)
                                ->update([
                                    'name'               =>@$payload['name'],                    
                                    'category_id'        =>@$payload['category_id'],
                                    'price'              =>@$payload['price'],
                                    'discounted_price'   =>@$payload['discounted_price'],
                                    'main_price'         =>@$main_price,
                                    'quantity'           =>@$payload['quantity'],
                                    'unit_id'            =>@$payload['unit_id'],
                                    'weight'             =>@$payload['weight'],
                                    'length'             =>@$payload['length'],
                                    'height'             =>@$payload['height'],
                                    'width'              =>@$payload['width'],
                                    'description'        =>@$payload['description']
                        ]);      
        
        if($request->has('images') && $request->images){
            foreach($request->images as $key => $value) {
                $image = isset($value) && !empty($value) ? $value:'';  
                $imageThumbnail = isset($value) && !empty($value) ? $value:'';  
                if(isset($value)){
                    if($image){ 
                      $directory = 'frontend/assets/img/product';
                      $type = 'logo';
                      $imagedata = $this->uploadimage($directory,$type, $image, '');
                        if(isset($imagedata) && $imagedata != ''){
                            $image = $imagedata['image'];
                        }
                    }
                }
                $new_file = url('/').'/frontend/assets/img/product/'.$image; 
                // Thumbnail image
                if ($new_file) {
                    $profile = preg_replace('/\..+$/', '', $imageThumbnail->getClientOriginalName()).time().'.'.$imageThumbnail->getClientOriginalExtension();
                    $img_thmbnail = $this->resizeImage($new_file,$profile);
                }                
                SellerImage::create([
                           'product_id'  => $id,                         
                           'image'       => @$image,
                           'thumbnail_image' => @$img_thmbnail
                        ]);      
            }
        }

        if($request->has('colors')){
            SellerProductColor::where('product_id',$id)->delete();
            if($request->colors){
                $colors = json_decode($request->colors,true);
                foreach($colors as $key => $value1) {           
                    SellerProductColor::create([
                           'seller_id'   =>  $sellerInformation['id'],
                           'product_id'  =>  $id, 
                           'name'        =>  $value1['name'],                         
                           'color_code'  =>  $value1['color_code']                         
                        ]);      
                }                
            }
        }

        if($request->has('sizes')){
            SellerProductSize::where('product_id',$id)->delete();
            if($request->sizes){
                $size = json_decode($request->sizes,true);
                foreach($size as $key => $value2) {         
                    SellerProductSize::create([
                        'seller_id'         =>  $sellerInformation['id'],
                        'product_id'        =>  $id, 
                        'size'              =>  $value2['size'],                         
                        'size_price'        =>  $value2['price'],
                        'discount_price'    =>  $value2['discount_price'],
                        'quantity'          =>  $value2['quantity']
                    ]);      
                }                
            }
        }

        return response()->json(['status' => true,'message' => 'Product has been updated', 'code' => 200]);
    }

    public function deleteProductImage(Request $request, $image_id)
    {
        $product_image = SellerImage::findOrFail($image_id);
        $image = $product_image->image;
        if($image){
            if(file_exists('public/frontend/assets/img/product'.'/'.$image) ) {
                unlink('public/frontend/assets/img/product'.'/'.$image);
            }            
        }
        $product_image->delete();
        return response()->json(['status' => true,'message' => 'Product image deleted sucessfully', 'code' => 200]);
    }
    
    public function deleteProduct(Request $request,$id){
        $sellerProduct = SellerProduct::where('id',$id)->first();
        // print_r($sellerProduct);die();
        if($sellerProduct){
       
            SellerProductColor::where('product_id',$id)->delete();
            SellerProductSize::where('product_id',$id)->delete();

            $product_img_del = SellerImage::where('product_id',$id)->get();
            
            foreach ($product_img_del as $key => $value) {
                if(file_exists('public/frontend/assets/img/product'.'/'.$value['image']) ) {
                    unlink('public/frontend/assets/img/product'.'/'.$value['image']);
                }
            }

            SellerImage::where('product_id',$id)->delete();
            
            SellerProduct::where('id',$id)->delete();
            
            return response()->json(['status' => true,'message' => 'Product deleted sucessfully', 'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'Product not found', 'code' => 400]);
        }
    }

    //add discount coupon
    public function addDiscountCoupon(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'coupon_code'         =>'required|unique:seller_discount_coupons,coupon_code',
               'uses_per_count'      =>'required|numeric',
               'status'              =>'required'
            ]
        );
    
 
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = false;
             $response['message'] = $validator->errors()->first();
            return response()->json($response);
        }        
       
        $sellerInformationData  = Auth::guard('api')->user();

        $sellerInformation  = Seller::with('sellerDiscountCoupons')
                                        ->where('id',$sellerInformationData['id'])
                                        ->first();
        // dd($sellerInformation);                                
        $sellerDiscountCouponId = SellerDiscountCoupon::create([
                                'seller_id'             =>@$sellerInformation['id'],
                                'coupon_code'           =>@$input['coupon_code'],
                                'uses_per_count'        =>@$input['uses_per_count'],
                                'discount_type'         =>@$input['discount_type'],
                                'percent'               =>@$input['percent'],
                                'min_order_amount'      =>@$input['min_order_amount'],
                                'maximum_discount'      =>@$input['maximum_discount'],
                                'discount_amount'       =>@$input['discount_amount'],
                                'minimum_order_amount'  =>@$input['minimum_order_amount'],
                                'status'                =>@$input['status']
                        ])->id;

        $sellerDiscountCoupon = SellerDiscountCoupon::where('id',$sellerDiscountCouponId)->first(); 
           
        if($sellerDiscountCoupon){
            return response()->json(['status' => true,'message' => 'Discount coupon added','sellerDiscountCoupon'=>$sellerDiscountCoupon,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'Something went wrong', 'code' => 400]);
        }
    }

    public function editDiscountCoupon(Request $request,$id)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'coupon_code'         =>'required',
               'uses_per_count'      =>'required|numeric',
               'status'              =>'required'
            ]
        );
    
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }        

        $sellerInformation  = Seller::with('sellerDiscountCoupons')
                                        ->where('mobile_number',$input['mobile_number'])
                                        ->first();

        $sellerDiscountCouponId = SellerDiscountCoupon::where('id',$id)
                                        ->update([
                                // 'seller_id'             =>@$sellerInformation['id'],
                                'coupon_code'           =>@$input['coupon_code'],
                                'uses_per_count'        =>@$input['uses_per_count'],
                                'discount_type'         =>@$input['discount_type'],
                                'percent'               =>@$input['percent'],
                                'min_order_amount'      =>@$input['min_order_amount'],
                                'maximum_discount'      =>@$input['maximum_discount'],
                                'discount_amount'       =>@$input['discount_amount'],
                                'minimum_order_amount'  =>@$input['minimum_order_amount'],
                                'status'                =>@$input['status']
                        ])->id;
        $sellerDiscountCoupon = SellerDiscountCoupon::where('id',$id)->first();
            
        if($sellerDiscountCoupon){
            return response()->json(['status' => true,'message' => 'Discount coupon updated','sellerDiscountCoupon'=>$sellerDiscountCoupon,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'Something went wrong', 'code' => 400]);
        }
    }


    public function getDiscountCoupon(Request $request)
    {
        $input = $request->all();
        
        $sellerInformationData  = Auth::guard('api')->user();

        $sellerInformation  = Seller::with('sellerDiscountCoupons')
                                           ->where('id',$sellerInformationData['id'])
                                           ->first();
        if($sellerInformation){
            return response()->json(['status' => true,'message' => 'Get discount coupon list','sellerInformation'=>$sellerInformation,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No discount coupon found', 'code' => 400]);
        }
    }

    
    public function changeStatusDiscountCoupon(Request $request,$discount_coupon_id)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'status'              =>'required'
            ]
        );
    
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }        

        $sellerDiscountCouponId = SellerDiscountCoupon::where('id',$discount_coupon_id)
                                     ->update([
                                             'status'     =>@$input['status']
                                        ]);

        $sellerDiscountCoupon = SellerDiscountCoupon::where('id',$discount_coupon_id)->first();

        if($sellerDiscountCoupon){
            return response()->json(['status' => true,'message' => 'Discount coupon status change','discountCounponStatus'=>$sellerDiscountCoupon,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'Something went wrong', 'code' => 400]);
        }
    }


    public function deleteDiscountCoupon($id){
        
        $sellerProduct = SellerDiscountCoupon::where('id',$id)->first();
        if($sellerProduct){
            SellerDiscountCoupon::where('id',$id)->delete();
            return response()->json(['status' => true,'message' => 'discount coupon deleted sucessfully', 'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'discount coupon not found', 'code' => 400]);
        }
    }

    public function addAdditionalInformation(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'field_name'         =>'required',
               'field_type'         =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }        

        $sellerInformation  = Seller::with('sellerDiscountCoupons')
                                        ->where('mobile_number',$input['mobile_number'])
                                        ->first();

        SellerAdditionalInformation::create([
                                    'seller_id'     => $sellerInformation['id'],
                                    'field_name'    => @$input['field_name'],
                                    'field_type'    => @$input['field_type'],
                                    'is_required'   => @$input['is_required']
                                ]);

        $additionalInformation = SellerAdditionalInformation::where('seller_id', $sellerInformation['id'])                                                  ->get();
            
        if($additionalInformation){
            return response()->json(['status' => true,'message' => 'Additional information added','additionalInformation'=>$additionalInformation,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'Something went wrong', 'code' => 400]);
        }
    }

    public function editAdditionalInformation(Request $request,$id)
    {
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'field_name'         =>'required',
               'field_type'         =>'required'
            ]
        );
    
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }        

        $sellerInformation  = Seller::with('sellerDiscountCoupons')
                                        ->where('mobile_number',$input['mobile_number'])
                                        ->first();

        SellerAdditionalInformation::where('id',$id)->update([
                                    'field_name'    => @$input['field_name'],
                                    'field_type'    => @$input['field_type'],
                                    'is_required'   => @$input['is_required']
                                ]);
        $additionalInformation = SellerAdditionalInformation::where('seller_id', $sellerInformation['id'])                                                  ->get();
            
        if($additionalInformation){
            return response()->json(['status' => true,'message' => 'Additional information updated','additionalInformation'=>$additionalInformation,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'Something went wrong', 'code' => 400]);
        }
    }

    public function deleteAdditionalInformation($id){
        
        $sellerProduct = SellerAdditionalInformation::where('id',$id)->first();
        if($sellerProduct){
            SellerAdditionalInformation::where('id',$id)->delete();
            return response()->json(['status' => true,'message' => 'Seller additional information deleted sucessfully', 'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'Seller additional information not found', 'code' => 400]);
        }
    }

    public function addTermAndCondtion(Request $request){
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'title'         =>'required',
               'description'   =>'required'
            ]
        );
        
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }    

        $sellerInformation  = Auth::guard('api')->user();
        $page = Page::where('type','seller')
                    ->where('user_id',$sellerInformation['id'])
                    ->where('page_name','term')
                    ->first();   
        // dd($sellerInformation,$page);

        if(empty($page)){
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
            $sellerInformation  = Auth::guard('api')->user();

            $pageId = Page::create([
                        'type'          =>'seller',
                        'user_id'       =>$sellerInformation['id'],
                        'page_name'     =>'term',
                        'title'         =>$request->title,
                        'description'   =>$request->description                
                    ])->id;

                if($pageId){
                    return response()->json(['status' => true,'message' => 'Information Updated sucessfully', 'code' => 200]);
                }else{
                    return response()->json(['status' => false,'message' => 'Information not found', 'code' => 400]);
                }
        }else{
            $sellerInformation  = Auth::guard('api')->user();

            // update Page
            $pageUpdate = Page::where('type','seller')
                            ->where('user_id',$sellerInformation['id'])
                            ->where('page_name','term')
                            ->update([
                                    'title'         =>$input['title'],
                                    'description'   =>$input['description']                
                            ]); 
            if($pageUpdate){
                return response()->json(['status' => true,'message' => 'Information Updated sucessfully', 'code' => 200]);
            }else{
                return response()->json(['status' => false,'message' => 'Information not found', 'code' => 400]);
            }
        }
    }

    public function getTermAndCondtion(Request $request)
    {
        $input = $request->all();
        $user  = Auth::guard('api')->user();

        $sellerInformation  = Seller::where('id',$user['id'])
                                    ->first();
                                                                                                                                                                        
        $page = Page::where('type','seller')
                    ->where('user_id',$user['id'])
                    ->where('page_name','term')
                    ->first();

        // dd($page);

        if($page){
            return response()->json(['status' => true,'message' => 'Get term and condtion information','termAndCondtionInformation'=>$page,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No term and condtion information found', 'code' => 400]);
        }
    }

    // getTermAndCondtion
    // addTermAndCondtion
    // getPrivacyAndPolicy
    // addPrivacyAndPolicy

    public function addPrivacyAndPolicy(Request $request){
        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'title'         =>'required',
               'description'   =>'required'
            ]
        );
        
        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = $validator->errors()->first();
             $response['message'] = "missing parameters";
            return response()->json($response);
        }     
        $sellerInformation  = Auth::guard('api')->user();
        // dd($sellerInformation['id']);
        $page= Page::where('type','seller')
                    ->where('user_id',$sellerInformation['id'])
                    ->where('page_name','privacy')
                    ->first();   

        if(empty($page)){
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title)));
            $sellerInformation  = Auth::guard('api')->user();

            $pageId = Page::create([
                        'type'          =>'seller',
                        'user_id'       =>$sellerInformation['id'],
                        'page_name'     =>'privacy',
                        'title'         =>$request->title,
                        'description'   =>$request->description,                
                    ])->id;

                if($pageId){
                    return response()->json(['status' => true,'message' => 'Information Updated sucessfully', 'code' => 200]);
                }else{
                    return response()->json(['status' => false,'message' => 'Information not found', 'code' => 400]);
                }
        }else{
            // update Page
            $sellerInformation  = Auth::guard('api')->user();

            $pageUpdate = Page::where('type','seller')
                            ->where('user_id',$sellerInformation['id'])
                            ->where('page_name','privacy')
                            ->update([
                                    'title'         =>$input['title'],
                                    'description'   =>$input['description']                
                            ]); 

             $privacyPolicy = Page::where('type','seller')
                                    ->where('user_id',$sellerInformation['id'])
                                    ->where('page_name','privacy')
                                    ->first();    

            if($pageUpdate){
                return response()->json(['status' => true,'privacyPolicyInformation'=>$privacyPolicy,'message' => 'Information Updated sucessfully', 'code' => 200]);
            }else{
               return response()->json(['status' => false,'message' => 'Information not found', 'code' => 400]);

            }
        }
    }

    public function getPrivacyAndPolicy(Request $request)
    {
        $input = $request->all();
        $user_id  = Auth::guard('api')->user();

        $sellerInformation  = Seller::where('id',$user_id['id'])
                                    ->first();

        $page = Page::where('type','seller')
                    ->where('user_id',$user_id['id'])
                    ->where('page_name','privacy')
                    ->first();
        if($page){
            return response()->json(['status' => true,'message' => 'Get privacy and policy information','termAndCondtionInformation'=>$page,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No privacy and policy information found', 'code' => 400]);
        }
    }

    public function getOrder(Request $request){
        $sellerInformation  = Auth::guard('api')->user();
        
        $orders = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','orderDetails.orderProduct','orderDetails.orderProduct.sellerProductImages','user','orderStatus')
                    ->where('seller_id',$sellerInformation['id'])
                    ->get();
            
        $orderCount['pendingOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                ->where('seller_id',$sellerInformation['id'])
                                ->where('status',1)
                                ->count();

        $orderCount['acceptedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                    ->where('seller_id',$sellerInformation['id'])
                                    ->where('status',2)
                                    ->count();

        $orderCount['cancelledOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                    ->where('seller_id',$sellerInformation['id'])
                                    ->where('status',3)
                                    ->count();

        $orderCount['shippedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                    ->where('seller_id',$sellerInformation['id'])
                                    ->where('status',4)
                                    ->count();

        $orderCount['deliveredOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                    ->where('seller_id',$sellerInformation['id'])
                                    ->where('status',5)
                                    ->count();

        $orderCount['rejectedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                    ->where('seller_id',$sellerInformation['id'])
                                    ->where('status',11)
                                    ->count();                                                                            

        $orderCount['allOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                            ->where('seller_id',$sellerInformation['id'])
                                            ->count();                                                        

                    
        if ($orders) {
            return response()->json(['status' => true,'message' => 'All order list','orders'=>$orders,'orderCount'=>$orderCount,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No order list found', 'code' => 400]);
        }            
    }

    public function getOrderDetail(Request $request,$orderId){
        $sellerInformation  = Auth::guard('api')->user();

        $myOrder = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                            ->where('seller_id',$sellerInformation['id'])  
                            ->where('id',$orderId)
                            ->first();
        
        $pluckProduct  = ordersDetail::where('order_id',$orderId)
                                        ->pluck('product_id');

        $sellerProduct   = SellerProduct::whereIn('id',$pluckProduct)
                                    ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
                                    ->get();
                      
        if ($sellerProduct) {
            return response()->json(['status' => true,'message' => 'Order Detail','orders'=>$myOrder,'sellerProduct'=>$sellerProduct,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No Order Detail found', 'code' => 400]);
        }
    }            


    // 
    public function acceptedOrder(Request $request,$orderId){

        $sellerInformation  = Auth::guard('api')->user();

        Order::where('seller_id',$sellerInformation['id'])
            ->where('id',$orderId)
            ->update(['status'=>'2']);

        $myOrder = Order::where('seller_id',$sellerInformation['id'])
                            ->where('id',$orderId)
                            ->first();
        if ($myOrder) {
            return response()->json(['status' => true,'message' => 'Order accepted successfully','myOrder'=>$myOrder,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }            
    // 
 
    public function rejectedOrder(Request $request,$orderId){

        $sellerInformation  = Auth::guard('api')->user();

        Order::where('seller_id',$sellerInformation['id'])
            ->where('id',$orderId)
            ->update(['status'=>'11']);

        $myOrder = Order::where('seller_id',$sellerInformation['id'])
                            ->where('id',$orderId)
                            ->first();
        // dd($myOrder);
        if ($myOrder) {
            return response()->json(['status' => true,'message' => 'Order rejected successfully','myOrder'=>$myOrder,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }
    
    public function getPendingOrder(Request $request){ 
        $input                  = $request->all();
        $sellerInformationData  = Auth::guard('api')->user();

        $orders = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','orderDetails.orderProduct','orderDetails.orderProduct.sellerProductImages','user','orderStatus')
                          ->where('seller_id',$sellerInformationData['id'])
                          ->orderBy('id','DESC')->where('status',1);

        if(isset($input['order_type'])){
            $order_type    = @$input['order_type'];
            if($order_type=='Pending'){
                $orders       = $orders->paginate(8);
        
                $orderCount['pendingOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                      ->where('seller_id',$sellerInformationData['id'])
                                      ->where('status',1)
                                      ->count();

                $orderCount['acceptedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',2)
                                          ->count();

                $orderCount['cancelledOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',3)
                                          ->count();

                $orderCount['shippedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',4)
                                          ->count();

                $orderCount['deliveredOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',5)
                                          ->count();

                $orderCount['rejectedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',11)
                                          ->count();                                                                            

                $orderCount['allOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')->where('seller_id',$sellerInformationData['id'])->count();
           } 
            return response()->json(['status' => true,'message' => 'PendingOrderList','orders'=>$orders,'orderCount'=>$orderCount,'code' => 200]);
        }
        return response()->json(['status' => false,'message' => 'error', 'code' => 400]);
    }

    public function getAcceptedOrder(Request $request){

        $input                  = $request->all();
        $sellerInformationData  = Auth::guard('api')->user();

        $orders = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','orderDetails.orderProduct','orderDetails.orderProduct.sellerProductImages','user','orderStatus')
                          ->where('seller_id',$sellerInformationData['id'])
                          ->orderBy('id','DESC')->where('status',2);

        if(isset($input['order_type'])){
            $order_type    = @$input['order_type'];
            if($order_type=='Accepted'){
                $orders       = $orders->paginate(8);
        
                $orderCount['pendingOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                      ->where('seller_id',$sellerInformationData['id'])
                                      ->where('status',1)
                                      ->count();

                $orderCount['acceptedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',2)
                                          ->count();

                $orderCount['cancelledOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',3)
                                          ->count();

                $orderCount['shippedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',4)
                                          ->count();

                $orderCount['deliveredOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',5)
                                          ->count();

                $orderCount['rejectedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',11)
                                          ->count();                                                                            

                $orderCount['allOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')->where('seller_id',$sellerInformationData['id'])->count();
           } 
            return response()->json(['status' => true,'message' => 'AcceptedOrderList','orders'=>$orders,'orderCount'=>$orderCount,'code' => 200]);
        }
        return response()->json(['status' => false,'message' => 'error', 'code' => 400]);
    }            
    
    public function getRejectedOrder(Request $request){

        $sellerInformation  = Auth::guard('api')->user();

        $myOrder = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                            ->where('seller_id',$sellerInformation['id'])  
                            // ->where('id',$orderId)
                            ->where('status','11')
                             ->get();

        $myOrderCount = Order::where('seller_id',$sellerInformation['id'])  
                            ->where('status','11')
                            ->count();

        $myOrderPluck = Order::where('seller_id',$sellerInformation['id'])  
                            ->where('status','11')
                            ->pluck('id');

        $pluckProduct  = ordersDetail::whereIn('order_id',$myOrderPluck)
                                        ->pluck('product_id');

        $sellerProduct   = SellerProduct::whereIn('id',$pluckProduct)
                                    ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
                                    ->get();
        if ($myOrder) {
            return response()->json(['status' => true,'message' => 'Get rejected order list successfully','rejectedOrder'=>$myOrder,'rejectedOrderCount'=>$myOrderCount,'products'=>$sellerProduct,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }            
    
    public function getCancelledOrder(Request $request){

        $sellerInformation  = Auth::guard('api')->user();

        $myOrder = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                            ->where('seller_id',$sellerInformation['id'])  
                            ->where('status','3')
                            ->get();
        
        $myOrderCount = Order::where('seller_id',$sellerInformation['id'])  
                         ->where('status','3')
                         ->count();

        $myOrderPluck = Order::where('seller_id',$sellerInformation['id'])  
                         ->where('status','3')
                         ->pluck('id');
        

        $pluckProduct  = ordersDetail::whereIn('order_id',$myOrderPluck)
                                        ->pluck('product_id');

        $sellerProduct   = SellerProduct::whereIn('id',$pluckProduct)
                                    ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
                                    ->get();
        if ($myOrder) {
            return response()->json(['status' => true,'message' => 'Get cancelled order list successfully','cancelledOrder'=>$myOrder,'cancelledOrderCount'=>$myOrderCount,'products'=>$sellerProduct,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }            
    
    public function getShippedOrder(Request $request){
        $input                  = $request->all();
        $sellerInformationData  = Auth::guard('api')->user();

        $orders = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','orderDetails.orderProduct','orderDetails.orderProduct.sellerProductImages','user','orderStatus')
                          ->where('seller_id',$sellerInformationData['id'])
                          ->orderBy('id','DESC')
                          ->where('status',4);

        if(isset($input['order_type'])){
            $order_type    = @$input['order_type'];
            if($order_type=='Shipped'){
                $orders       = $orders->paginate(8);
        
                $orderCount['pendingOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                      ->where('seller_id',$sellerInformationData['id'])
                                      ->where('status',1)
                                      ->count();

                $orderCount['acceptedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',2)
                                          ->count();

                $orderCount['cancelledOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',3)
                                          ->count();

                $orderCount['shippedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',4)
                                          ->count();

                $orderCount['deliveredOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',5)
                                          ->count();

                $orderCount['rejectedOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                                          ->where('seller_id',$sellerInformationData['id'])
                                          ->where('status',11)
                                          ->count();                                                                            

                $orderCount['allOrderCount'] = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')->where('seller_id',$sellerInformationData['id'])->count();
           } 
            return response()->json(['status' => true,'message' => 'ShippedOrderList','orders'=>$orders,'orderCount'=>$orderCount,'code' => 200]);
        }
        return response()->json(['status' => false,'message' => 'error', 'code' => 400]);
    }

    public function getDeliveredOrder(Request $request){

        $sellerInformation  = Auth::guard('api')->user();

        $myOrder = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                            ->where('seller_id',$sellerInformation['id'])  
                            // ->where('id',$orderId)
                            ->where('status','5')
                            ->get();
                                  
        $myOrderCount = Order::where('seller_id',$sellerInformation['id'])  
                       ->where('status','5')
                       ->count();

        $myOrderPluck = Order::where('seller_id',$sellerInformation['id'])  
                       ->where('status','5')
                       ->pluck('id');
        // dd($myOrderPluck);                                
        $pluckProduct  = ordersDetail::whereIn('order_id',$myOrderPluck)
                                        ->pluck('product_id');

        $sellerProduct   = SellerProduct::whereIn('id',$pluckProduct)
                                    ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
                                    ->get();
        if ($myOrder) {
            return response()->json(['status' => true,'message' => 'Get delivered order list successfully','deliveredOrder'=>$myOrder,'deliveredOrderCount'=>$myOrderCount,'products'=>$sellerProduct,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }


    public function getSellerExtraChargeList(Request $request){

        $input = $request->all();
        $sellerInformationData  = Auth::guard('api')->user();
        $sellerExtraCharge = SellerExtraCharge::where('seller_id',$sellerInformationData['id'])->get();

        if ($sellerExtraCharge) {
            return response()->json(['status' => true,'message' => 'Get seller extra charge list successfully','sellerExtraChargeList'=>$sellerExtraCharge,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }

    public function addSellerExtraCharge(Request $request){

        $input = $request->all();
        $validator = Validator::make(
            $request->all(),
            [
               'charge_type'         =>'required',
               'charge_name'         =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = false;
             $response['message'] = $validator->errors()->first();
            return response()->json($response);
        }        

        $sellerInformationData  = Auth::guard('api')->user();

        $sellerExtraChargeId = SellerExtraCharge::create([
                                        'seller_id'             =>@$sellerInformationData['id'],
                                        'charge_type'           =>@$input['charge_type'],
                                        'charge_name'           =>@$input['charge_name'],
                                        'charges_in_percent'    =>@$input['charges_in_percent'],
                                        'charges_in_flat_price' =>@$input['charges_in_flat_price']
                                    ])->id;

        $sellerExtraCharge = SellerExtraCharge::where('id',$sellerExtraChargeId)->first();

        if ($sellerExtraCharge) {
            return response()->json(['status' => true,'message' => 'Seller extra charge added successfully','code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }   

    
    
    public function getSellerGstChargeList(Request $request){

        $input = $request->all();
    
        $sellerInformationData  = Auth::guard('api')->user();

        $SellerGstCharge = SellerGstCharge::where('seller_id',$sellerInformationData['id'])->get();

        if ($SellerGstCharge) {
            return response()->json(['status' => true,'message' => 'Get seller gst charge list successfully','SellerGstChargeList'=>$SellerGstCharge,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }


    public function addSellerGstCharge(Request $request){

        $input = $request->all();
        $validator = Validator::make(
        $request->all(),
            [
               'gst_number'          =>'required',
               'gst_percentage'      =>'required',
               'status'              =>'required'
            ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = false;
             $response['message'] = $validator->errors()->first();
            return response()->json($response);
        }        
        $sellerInformationData  = Auth::guard('api')->user();

        $checkSellerExtraChargeExist = SellerGstCharge::where('seller_id',$sellerInformationData['id'])->first();

        if($checkSellerExtraChargeExist){
            $sellerExtraChargeId = SellerGstCharge::where('seller_id',$sellerInformationData['id'])->update([
                                    'gst_number'            =>@$input['gst_number'],
                                    'gst_percentage'        =>@$input['gst_percentage'],
                                    'status'                =>@$input['status']
                            ]);
            $SellerGstCharge = SellerGstCharge::where('seller_id',$sellerInformationData['id'])->first();            

            if ($SellerGstCharge) {
                return response()->json(['status' => true,'message' => 'Seller gst charge updated successfully','code' => 200]);
            }else{
                return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
            }

        }else{
            $sellerExtraChargeId = SellerGstCharge::create([
                                            'seller_id'             =>@$sellerInformationData['id'],
                                            'gst_number'            =>@$input['gst_number'],
                                            'gst_percentage'        =>@$input['gst_percentage'],
                                            'status'                =>@$input['status']
                                        ])->id;

            $SellerGstCharge = SellerGstCharge::where('id',$sellerExtraChargeId)->first();            
           
            if ($SellerGstCharge) {
                return response()->json(['status' => true,'message' => 'Seller gst charge added successfully','code' => 200]);
            }else{
                return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
            }
        }
    }    

    public function getSellerCustomer(Request $request){
        
        $input = $request->all();

        $sellerInformation  = Auth::guard('api')->user();        

        $orders = Order::select('orders.*','user_addresses.user_id as userAddrId','user_addresses.name as custName','user_addresses.isd_code','user_addresses.mobile_number','user_addresses.pincode','user_addresses.address','user_addresses.city','orders.user_address_id as address_id', DB::raw('count(orders.user_address_id) as total_ordersCount'),DB::raw('SUM(orders.grand_total ) as total_sale'))
                                     ->join('user_addresses','orders.user_address_id','=','user_addresses.id')
                                     ->where('seller_id',$sellerInformation['id'])->groupBy('orders.user_address_id');
        


        $customer_name      = '';

        if(isset($input['customer_name'])){
            $customer_name      = @$input['customer_name'];

            if($customer_name!='' ){
                $orders = $orders->having('custName','LIKE','%'.$customer_name.'%');
            }  
        } 

        $orders =  $orders->paginate(8);
        if ($orders) {
            return response()->json(['status' => true,'message' =>'Get seller customers successfully','orders'=>$orders,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        } 

    }


    public function getAllUnits(Request $request){

        $input = $request->all();
    
        $sellerInformationData  = Auth::guard('api')->user();

        $Units = Unit::get();

        if ($Units) {
            return response()->json(['status' => true,'message' => 'Get all unit list successfully','unitList'=>$Units,'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);
        }
    }
    
    public function changeSellerAppStatus(Request $request){
        
        $input      = $request->all();
        $validator  = Validator::make(
            $request->all(),
                [
                   // 'offline_app_status_limit' => 'required',
                   'status'            => 'required'
                ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = false;
             $response['message'] = $validator->errors()->first();
            return response()->json($response);
        }        
        
        $sellerInformationData  = Auth::guard('api')->user();
        
        date_default_timezone_set('Asia/Calcutta'); 
        $currentTime        = date("H:i:s");
        
        if($input['offline_app_status_limit']=='one_hour'){
            $newTimeAdded = date('H:i:s', strtotime('60 minute'));
        }elseif($input['offline_app_status_limit']=='two_hour'){
            $newTimeAdded = date('H:i:s', strtotime('120 minute'));
        }elseif($input['offline_app_status_limit']=='four_hour'){
            $newTimeAdded = date('H:i:s', strtotime('240 minute'));
        }else{
            $newTimeAdded = date('H:i:s', strtotime('1440 minute'));
        }

        if($input['status']=='active'){
            $changeStatusSeller = Seller::where('id',$sellerInformationData['id'])
                                        ->update([
                                            'app_status'                =>'online',
                                            'offline_app_status_limit'  =>null,
                                            'offline_app_status_time'   =>null
                                        ]);
            return response()->json(['status' => true,'message' => 'Seller App status set to online','code' => 200]);

        }else{
            $changeStatusSeller = Seller::where('id',$sellerInformationData['id'])
                                        ->update([
                                            'app_status'                =>'offline',
                                            'offline_app_status_limit'  =>$input['offline_app_status_limit'],
                                            'offline_app_status_time'   =>$newTimeAdded
                                        ]);
            return response()->json(['status' => true,'message' => 'Seller App status set to offline','code' => 200]);
        }
    }


    public function searchProduct(Request $request){
        
        $input      = $request->all();
        
        $sellerInformationData  = Auth::guard('api')->user();

        $sellerProducts = SellerProduct::with('sellerProductColors','sellerProductSizes','sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                  ->where('seller_id',$sellerInformationData['id'])
                                  ->orderBy('id','DESC');
        $product_name  = '';

        if($input['product_name']!=''){
            $product_name  = @$input['product_name'];
            if($product_name!=''){
                $sellerProducts = $sellerProducts->where(function($q) use($product_name){
                                        $q->where('seller_products.name','LIKE','%'.$product_name.'%');
                                });
            }

            $sellerProducts       = $sellerProducts->paginate(8);
            return response()->json(['status' => true,'SearchProducts'=>$sellerProducts,'message' => 'Search products results','code' => 200]);

        }else{
            $sellerProducts          = $sellerProducts->paginate(8);
            return response()->json(['status' => true,'SearchProducts'=>$sellerProducts,'message' => 'All products','code' => 200]);
        }   
    }

    public function searchCategory(Request $request){
        
        $input      = $request->all();
        $sellerInformationData  = Auth::guard('api')->user();

        $sellerCategories = SellerCategory::with('seller')->where('seller_id',$sellerInformationData['id'])
                                            ->orderBy('id','DESC');
        $category_name  = '';

        if($input['category_name']!=''){
            $category_name  = @$input['category_name'];

            $sellerCategories = $sellerCategories->where(function($q) use($category_name){
                                        $q->where('seller_categories.name','LIKE','%'.$category_name.'%');
                                });

            $sellerCategories1       = $sellerCategories->paginate(8);
            // print_r($sellerCategories1); die();    

            return response()->json(['status' => true,'SearchCategories'=>$sellerCategories1,'message' => 'Search Categories results','code' => 200]);
        }else{
            $sellerCategories       = $sellerCategories->paginate(8);
            return response()->json(['status' => true,'SearchCategories'=>$sellerCategories,'message' => 'Search Categories results','code' => 200]);
        }        
    }

    
    public function searchOrderNumber(Request $request){
        $input      = $request->all();
        $sellerInformationData  = Auth::guard('api')->user();
        
        $query   = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','orderDetails.orderProduct','orderDetails.orderProduct.sellerProductImages','user','orderStatus')
                          ->where('seller_id',$sellerInformationData['id']);

        $lifetime     = '';
        $order_type   = '';
        $order_number = '';

        if(isset($input['lifetime'])){
            $lifetime      = @$input['lifetime'];

            if($lifetime=='today'){
                $orderData = $query->orderBy('id','DESC')->whereDate('created_at', date('Y-m-d'));
            }elseif($lifetime=='yesterday'){
                $orderData = $query->orderBy('id','DESC')->whereDate('created_at', date('Y-m-d',strtotime("-1 days")));
            }elseif($lifetime=='this_week'){
                $orderData = $query->orderBy('id','DESC')
                                 ->where('created_at', '>', Carbon::now()->startOfWeek())
                                 ->where('created_at', '<', Carbon::now()->endOfWeek());
            }elseif($lifetime=='this_month'){
                $date30 = Carbon::now()->subDays(30);
                $orderData = $query->orderBy('id','DESC')->where('created_at', '>=', $date30);
            }else{
                $orderData = $query->orderBy('id','DESC');
            }
        }

        if(isset($input['order_number'])){
            $order_number   = @$input['order_number'];
            
            $orderData      = $query->where(function($q) use($order_number){
                                         $q->where('orders.id','LIKE','%'.$order_number.'%');
                                  }); 
        } 

        if(isset($input['order_type'])){
            $order_type     = @$input['order_type'];
             
             if($order_type=='All'){
                $status = '';
             }else if($order_type=='Pending'){
                $status = 1;
             }else if($order_type=='Accepted'){
                $status = 2;
             }else if($order_type=='Cancelled'){
                $status = 3;
             }else if($order_type=='Shipped'){ 
                $status = 4;
             }else if($order_type=='Delivered'){
                $status = 5;
            }else{
                $status = 11;
            }
            //echo '<pre>'; print_r($orderData->get()->toArray()); die();
            $Countquery = $orderData;

            $status1 = clone $Countquery;
            $status2 = clone $Countquery;
            $status3 = clone $Countquery;
            $status4 = clone $Countquery;
            $status5 = clone $Countquery;
            $status6 = clone $Countquery;
            $status7 = clone $Countquery;

            
            $orderCount['pendingOrderCount']   = $status1->where('status',1)->count();

            $orderCount['acceptedOrderCount']  = $status2->where('status',2)->count();

            $orderCount['cancelledOrderCount'] = $status3->where('status',3)->count();
            
            $orderCount['shippedOrderCount']   = $status4->where('status',4)->count();

            $orderCount['deliveredOrderCount'] = $status5->where('status',5)->count();
            
            $orderCount['rejectedOrderCount']  = $status6->where('status',11)->count();                                                                            
            $orderCount['allOrderCount']       = $status7->count(); 

            if($order_type=='All'){
                $orderData  =  $query->paginate(8);
            }else{
                $orderData  =  $query->where('status',$status)->paginate(8);
            }
        }
        
        return response()->json(['status' => true,'message' => 'searchedOrderList','orders'=>$orderData,'orderCount'=>$orderCount,'code' => 200]);
    }
    // lifeTimeFilter

    public function QrCodeGenerate(Request $request){
        $qr = \QrCode::size(500)
                    ->format('png')
                    ->generate('codingdriver.com', public_path('images/qrcode.png'));
        return response()->json(['status' => false,'message' => 'No record found', 'code' => 400]);    
    }   

    public function logout(){
        // Auth::guard('api')->logout();
        Session::flush();
        return response()->json(['status' => true,'message' => 'logout successfully', 'code' => 200]);
    }


    public function getStoreSetting(Request $request){
        $sellerInformation  = Auth::guard('api')->user();
        $storeSetting       = SellerAdditionalInformation::where('seller_id',$sellerInformation['id'])->get();
        // $additional_fields = json_decode($storeSetting['additional_fields']);

        if($storeSetting){
            return response()->json(['status' => true,'additional_fields'=>$storeSetting,'message' =>'Store setting data', 'code' => 200]);
        }else{
            return response()->json(['status' => false,'message' => 'No record found','code' => 400]);    
        }
    }   

    // public function updateStoreSetting(Request $request){
    //     $input              = $request->all();
    //     $sellerInformation  = Auth::guard('api')->user();
    //     // print_r($input); die();
    //     $storeSetting       = StoreSetting::where('seller_id',$sellerInformation['id'])->first();
 
    //     if($storeSetting){
    //         StoreSetting::where('seller_id',$sellerInformation['id'])
    //                     ->update([
    //                         'additional_fields' =>@$input['additional_fields']
    //                     ]);
    //     }else{
    //         StoreSetting::create([
    //                     'seller_id'         =>$sellerInformation['id'],
    //                     'additional_fields' =>@$input['additional_fields']
    //                 ]);
    //     }

    //     return response()->json(['status' => true,'message' => 'Store setting updated successfuly','code' => 200]);
    // }

    public function addStoreSetting(Request $request){
        $input      = $request->all();
        $validator  = Validator::make(
            $request->all(),
                [
                   'field_type'         => 'required',
                   'field_name'         => 'required',
                   'is_required'        => 'required'
                ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = false;
             $response['message'] = $validator->errors()->first();
            return response()->json($response);
        } 

        $sellerInformation  = Auth::guard('api')->user();
        // print_r($input); die();
       
        SellerAdditionalInformation::create([
                'seller_id'   =>@$sellerInformation['id'],
                'field_type'  =>@$input['field_type'],
                'field_name'  =>@$input['field_name'],
                'is_required' =>@$input['is_required']
            ]);
         
        return response()->json(['status' => true,'message' => 'Store setting added successfuly','code' => 200]);
    }

    public function updateStoreSetting(Request $request,$storeId){
        $input      = $request->all();
        $validator  = Validator::make(
            $request->all(),
                [
                   'field_type'         => 'required',
                   'field_name'         => 'required'
                ]
        );

        if ($validator->fails()) {
            $response['code'] = 404;
            $response['status'] = false;
             $response['message'] = $validator->errors()->first();
            return response()->json($response);
        } 

        $sellerInformation  = Auth::guard('api')->user();
        // print_r($input); die();

        SellerAdditionalInformation::where('id',$storeId)->where('seller_id',@$sellerInformation['id'])
                    ->update([
                        'field_type'  =>@$input['field_type'],
                        'field_name'  =>@$input['field_name'],
                        'is_required' =>@$input['is_required']
                    ]);

        return response()->json(['status' => true,'message' => 'Store setting updated successfuly','code' => 200]);
    }

    public function deleteStoreSetting(Request $request,$storeId){
        $input      = $request->all();

        $sellerInformation  = Auth::guard('api')->user();
        // print_r($input); die();

        SellerAdditionalInformation::where('id',$storeId)
                                     ->where('seller_id',@$sellerInformation['id'])
                                     ->delete();

        return response()->json(['status' => true,'message' => 'Store setting deleted successfuly','code' => 200]);
    }

    public function resizeImage($file, $fileNameToStore) {
        // Resize image
        $resize = Image::make($file)->resize(100, null, function ($constraint) {
           $constraint->aspectRatio();
        })->encode('jpg');

        // $image =[];
        // Create hash value
        $hash = md5($resize->__toString());
        $image = $hash."jpg";
        $save = Storage::put("product-images/".$fileNameToStore, $resize->__toString());
        // dd($fileNameToStore);
        if($save) {

            return $fileNameToStore;
        }

        return false;
    }    

}   
