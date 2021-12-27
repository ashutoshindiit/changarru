<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\BuisnessCategory;
use App\Models\Seller;
use App\Models\SellerCategory;
use App\Models\SellerImage;
use App\Models\SellerProduct;
use App\Models\Unit;
use App\Models\ProductCart;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserSupport;
use App\Models\Order;
use App\Models\ordersDetail;
use App\Models\OrderStatus;
use App\Models\SellerCharge;
use App\Models\SellerExtraCharge;
use App\Models\OrderAddress;
use App\Models\CommissionSetting;
use DateTime;
use Date;
use Auth;

class PaymentController extends Controller
{
    public function updateCommissionSettings(Request $request){         
        if($request->isMethod('post')){
              $input  = $request->all();
              $update = CommissionSetting::first();   
              // dd($input['commission_role']);
              if($input['commission_role']=='user'){
                    if($update){
                          $update->commission_role              = @$request->commission_role;
                          $update->user_commision_type         = @$request->user_commision_type;
                          $update->user_commission_amount      = @$request->user_commission_amount;
                          $update->user_commission_percentage  = @$request->user_commission_percentage;

                          if ($update->save()){             
                            return redirect()->back()->with('success','Commission setting updated sucessfully');
                          }else{
                            Session::flash('error','Something went wrong');
                            return redirect()->back();
                          }
                    }else{
                          CommissionSetting::create([
                             'commission_role'             => @$request->commission_role,
                             'user_commision_type'         => @$request->user_commision_type,
                             'user_commission_amount'      => @$request->user_commission_amount,
                             'user_commission_percentage'  => @$request->user_commission_percentage
                          ]);
                          return redirect()->back()->with('success','Commission setting added sucessfully');
                    }
               }else{
                    if($update){
                        $update->commission_role              = @$request->commission_role;
                        $update->seller_commision_type         = @$request->seller_commision_type;
                        $update->seller_commission_amount      = @$request->seller_commission_amount;
                        $update->seller_commission_percentage  = @$request->seller_commission_percentage;

                        if ($update->save()){             
                            return redirect()->back()->with('success','Commission setting updated sucessfully');
                        }else{
                            Session::flash('error','Something went wrong');
                            return redirect()->back();
                        }
                    }else{

                        CommissionSetting::create([
                           'commission_role'              => @$request->commission_role,
                           'seller_commision_type'        => @$request->seller_commision_type,
                           'seller_commission_amount'     => @$request->seller_commission_amount,
                           'seller_commission_percentage' => @$request->seller_commission_percentage
                        ]);

                        return redirect()->back()->with('success','Commission setting added sucessfully');
                    }
              }

              Session::flash('error','Something went wrong');
              return redirect()->back();
          }   

        $commissionSetting = CommissionSetting::first();
        $page = 'commission';
        return view('backend.commission', compact('commissionSetting'));
    }

    public function paymentSetting(Request $request){
        $page = 'payment';
        return view('backend.payment',compact('page'));
    }

    public function allOrder(Request $request){
        $orders = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                        ->orderBy('id','DESC')->paginate(10);
        // dd($orders);
        $page  = 'order';
        return view('backend.orders',compact('page','orders'));
    }

    public function viewOrder(Request $request,$orderId){
        $myOrder = Order::with('orderAddress','orderDetails','orderDetails.seller','seller','user','orderStatus')
                            ->where('id',$orderId)
                            ->first();
        
        $pluckProduct  = ordersDetail::where('order_id',$orderId)
                                        ->pluck('product_id');

        $sellerProduct   = SellerProduct::whereIn('id',$pluckProduct)
                                    ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
                                    ->get();
        $page  = 'order';
        return view('backend.view-order',compact('page','myOrder','sellerProduct','orderId'));
    }

    
}
