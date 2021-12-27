<?php  
    if (Auth::check()) {
        $userId  = Auth::user()->id;
    }else{
        $userId   = @$_COOKIE['guestId'];
    }
    $sumProductPrice = \App\Models\ProductCart::where('user_id',$userId)->sum('total_price');
     

    $discountPriceSession       = Session::get('discount_price');
    $discountTypeSession         =  Session::get('discount_type');
    //Below for flat price case only
    $discounted_AmountSession    =  Session::get('discounted_Amount');
?>

<div class="coupon_code right">
    <h3>Cart Totals</h3>
    <div class="coupon_inner">
        <div class="cart_subtotal">
            <p>Subtotal</p>
            <p class="cart_amount">$ {{$sumProductPrice}}</p>
        </div>
        <!-- <div class="cart_subtotal "> -->
            <!-- <p>Shipping</p> -->
<!--             <p class="cart_amount"><span>
                Flat Rate:
            </span> $ 0.00</p>
        </div> -->
        <!-- <p>Calculate shipping</p> -->
            
        <?php if (isset($discountPriceSession) && isset($discountTypeSession)): ?>
            <div class="cart_subtotal">
               <p>Discount Copon Applied</p>
               <p class="cart_amount">- $ {{ ($discountTypeSession=='flat_discount')? $discounted_AmountSession:$discounted_AmountSession}}</p>
            </div>
        <?php endif ?>

        <div class="cart_subtotal">
           <p>Total</p>
           <p class="cart_amount">$ {{isset($discountPriceSession)? $discountPriceSession :$sumProductPrice}}</p>
        </div>
        <div class="checkout_btn">
            <a href="{{url('/'.$slug.'/cart-checkout')}}">Proceed to Checkout</a>
        </div>
    </div>
</div>
