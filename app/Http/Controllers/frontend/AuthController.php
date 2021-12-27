<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Seller;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductCart;
use Exception;
use Auth;

class AuthController extends Controller
{   
    public function login(Request $request)
      {
          // Check validation
          $this->validate($request, [
              'mobile_no' => 'required|regex:/[0-9]{10}/|digits:10',            
          ]);
          // Get user record
          $user = Seller::where('mobile_no', $request->get('mobile_no'))->first();
           // dd($user);
          
          // Check Condition Mobile No. Found or Not
          if($request->get('mobile_no') != $user->mobile_no) {
              \Session::put('errors', 'Your mobile number not match in our system..!!');
              return back();
          }
          \Auth::login($user);

          ////////code for cookie data store to product cart table/////////
           $user_id     = Auth::user()->id;
           $guest_id    = @$_COOKIE['guestId'];
           dd($user_id,$guest_id);
           $guest_items = ProductCart::where('user_id',$guest_id)->get()->toArray();
               if(!empty($guest_id) && !empty($guest_items)){
                  $user_items = ProductCart::where('user_id',$user_id)->get()->toArray();
                  $user_items = array_map(function($v){ return $v['id']; }, $user_items);
                  foreach($guest_items as $value){
                      if(in_array($value['id'], $user_items)){
                          ProductCart::where('id',$value['id'])->delete();
                      } else{
                          ProductCart::where('id',$value['id'])->update(['user_id'=>$user_id]);
                      }
                  }
                }
          ////////End code for cookie data store to product cart table/////////
 
          return redirect()->route('home');
      }
}
