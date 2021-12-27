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
use DateTime;
use Date;
use Auth;
use App\Models\Order;
use App\Models\ordersDetail;
use App\Models\OrderStatus;

use App\Models\SellerCharge;
use App\Models\SellerExtraCharge;

use App\Models\OrderAddress;

class OrderController extends Controller
{
    public function createOrder(Request $request){
        $data = $request->all();
        $getOrderStatus = OrderStatus::get();
        $myArray = json_decode(stripcslashes($data['myarray']));

        $sellerCharge = SellerCharge::where('seller_id',1)
                                    ->where('gst','active')->first();
                                    
        $sellerExtraCharge = SellerExtraCharge::where('seller_id',1)->get();
        // dd($data,Session::get('discounted_Amount'), Session::has('discounted_Amount'));
        $response= [];
        $userAddress = UserAddress::where('id',$data['selectedAddressId'])->first();
        
        $orderAddressId = OrderAddress::create([
                            'user_id'       => Auth::user()->id,
                            'name'          => $userAddress['name'],
                            'address'       => $userAddress['address'],
                            'isd_code'      => $userAddress['isd_code'],
                            'city'          => $userAddress['city'],
                            'pincode'       => $userAddress['pincode'],
                            'mobile_number' => $userAddress['mobile_number']
                        ])->id;

        $orderId    = Order::create([
                        'order_address_id'      => $orderAddressId,
                        'user_id'               => $data['userId'],
                        // 'seller_id'             => $data['seller_id'],
                        'total_price'           => $data['final_price'],
                        'coupon_added'          => (Session::has('coupon_name')) ? 'yes' :'no',
                        'coupon_name'           => (Session::has('coupon_name')) ? Session::get('coupon_name') :null,
                        'coupon_price'          => (Session::has('discounted_Amount')) ? Session::get('discounted_Amount'):null,
                        'tax'                   => $data['tax'],
                        'other_tax'             => json_encode($sellerExtraCharge),
                        'grand_total'           => $data['grand_total_price'],
                        'status'                => $getOrderStatus['0']['id'],
                        'payment_type'          => 'cash'
            ])->id;

        

        $cartItems  = ProductCart::where('user_id',$data['userId'])->get();

        foreach ($cartItems as $key => $value) {
            $productCart = SellerProduct::where('id',$value['product_id'])->first();

            $cartProductCount   = ProductCart::where('user_id',$data['userId'])
                                    ->where('product_id',$value['product_id'])
                                    ->first();

            ordersDetail::create([
                    'order_id'              =>  $orderId,
                    'seller_id'             =>  $productCart['seller_id'],
                    'product_id'            =>  $value['product_id'],
                    'product_quantity'      =>  $value['product_quantity'],
                    'product_quantity_price' => $value['product_quantity_price'],
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
        $cartItems = ProductCart::where('user_id',$data['userId'])->delete();
        Session::forget('discounted_Amount');
        Session::forget('discount_price');
        Session::forget('discount_type');
        Session::forget('coupon_name');

        $response['userId'] =  1;
        $response['status'] = 'true';
        $response['msg']    = 'Order created successfully';      

        return $response; 
      }

      public function orderCompleted(Request $request,$slug){
        return view('frontend.order-completed',compact('slug'));
      }

}
