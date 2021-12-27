<?php  
     
    $discountPriceSession        = Session::get('discount_price');
    $discountTypeSession         =  Session::get('discount_type');
    //Below for flat price case only
    $discounted_AmountSession    =  Session::get('discounted_Amount');

  if (Auth::check()) {
      $userId  = Auth::user()->id;
      $item_count = App\Models\ProductCart::where('user_id',$userId)
                                          ->get()
                                          ->count();   
                                          
      $pluckProduct  = App\Models\ProductCart::where('user_id',$userId)->pluck('product_id');
      
      // $sellerProduct = App\Models\SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')->whereIn('id',$pluckProduct)
      //                    ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
      //                    ->limit(3)
      //                    ->get();
      
      $sellerProduct = App\Models\ProductCart::with('Product.sellerProductColors','Product.sellerProductSizes','Product.sellerInfo','Product.sellerProductImages','Product.sellerUnit','Product.sellerCategory')->where('user_id',$userId)->whereIn('product_id',$pluckProduct)->limit(3)->get();    

      $sellerProductCount = App\Models\SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
                         ->whereIn('id',$pluckProduct)
                         ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                         ->get();                           
                         
      $sumProductPrice = App\Models\ProductCart::where('user_id',$userId)->sum('total_price');                                           
      // dd(count($sellerProduct));                                                               
   }else{
      $userId  = @$_COOKIE['guestId'];
      $item_count = App\Models\ProductCart::where('user_id',$userId)->count();
      $pluckProduct = App\Models\ProductCart::where('user_id',$userId)->pluck('product_id');

      // $sellerProduct = App\Models\SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
      //                                             ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
      //                                             ->whereIn('id',$pluckProduct)
      //                                             ->limit(3)
      //                                             ->get();

      $sellerProduct = App\Models\ProductCart::with('Product.sellerProductColors','Product.sellerProductSizes','Product.sellerInfo','Product.sellerProductImages','Product.sellerUnit','Product.sellerCategory')->where('user_id',$userId)->whereIn('product_id',$pluckProduct)->limit(3)->get();                                       

      $sellerProductCount = App\Models\SellerProduct::with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory','productCart')
                                                ->whereIn('id',$pluckProduct)
                                                ->with('sellerInfo','sellerProductImages','sellerUnit','sellerCategory')
                                                ->get();

      $sumProductPrice = App\Models\ProductCart::where('user_id',$userId)->sum('total_price');
      // dd($sumProductPrice);     

   }
?>


    
        <div class="cart_gallery">
            <div class="cart_close">
                <div class="cart_text">
                    <h3>cart</h3> </div>
                <div class="mini_cart_close"> <a href="javascript:void(0)"><i class="icon-x"></i></a> </div>
            </div>
            @if(count($sellerProduct)!=0)
                <?php  foreach ($sellerProduct as $key => $product):   ?> 
                    <?php   
                        $sellerProductColorRecord = \App\Models\SellerProductColor::where('id',$product['color_id'])->first();
                        $sellerProductSizeRecord  = \App\Models\SellerProductSize::where('id',$product['size_id'])->first();


                    ?>

                    <div class="cart_item">
                        <div class="cart_img">
                            <a href="#">
                                <img src="{{@$product['Product']['sellerProductImages'][0]['image']?asset('frontend/assets/img/product/'.@$product['Product']['sellerProductImages'][0]['image']):asset('frontend/images/default.jpg')}}" alt="" >
                            </a>
                        </div>




                        <div class="cart_info"> <a href="#">{{$product['Product']['name']}}</a>
                            @if(isset($sellerProductSizeRecord['size']))
                            <p class="prod-unit-txt">Size:{{@$sellerProductSizeRecord['size']}}</p>
                            @endif

                            @if(isset($sellerProductColorRecord['name'])) 
                            <p class="prod-unit-txt">Color: {{@$sellerProductColorRecord['name']}}</p>
                            @endif
                            
                            <p>{{$product['product_quantity']}} x <span>
                             @if($product['total_price']!=null)
                                $ {{$product['total_price'] }}
                             @endif
                              </span></p>
                        </div>
                        <div class="cart_remove"> <a href="{{url('/'.$slug.'/'.'delete-cart-product'.'/'.$product['id'])}}"><i class="icon-x"></i></a> </div>
                    </div>
               <?php endforeach ?>
            @endif

            @if(count($sellerProductCount)>3)
                <a href="{{url('/'.$slug.'/view-cart-detail')}}">See More</a>
            @endif

        </div>
        @if(count($sellerProduct)!=0)
        <div class="mini_cart_table">
            <div class="cart_table_border">
                <div class="cart_total"> <span>Sub total:</span> <span class="price">$ {{$sumProductPrice}} </span> </div>
                <?php if (isset($discountPriceSession) && isset($discountTypeSession)): ?>
                    <div class="cart_subtotal">
                       <p>Discount Coupon Applied</p>
                       <p class="cart_amount">- $ {{ ($discountTypeSession=='flat_discount')? $discounted_AmountSession:$discounted_AmountSession}}</p>
                    </div>
                <?php endif ?>

                <div class="cart_total mt-10"> <span>Total:</span> <span class="price">$ {{($discountPriceSession!=null)? $discountPriceSession :$sumProductPrice}}</span> </div>
            </div>
        </div>
        <div class="mini_cart_footer">
            <div class="cart_button"> <a href="{{url('/'.$slug.'/view-cart-detail')}}"><i class="fa fa-shopping-cart"></i> View cart</a> </div>
            <div class="cart_button"> <a href="{{url('/'.$slug.'/cart-checkout')}}"><i class="fa fa-sign-in"></i> Checkout</a> </div>
        </div>
        @endif

         @if(count($sellerProduct)==0)
            <div class="text-center">
              <p>Your Cart is empty</p>
           </div>
        @endif
        
    

