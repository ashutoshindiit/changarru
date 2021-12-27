@include('frontend.common.header')

<!--Checkout page section-->

<style>

    .chepadd

       {

            padding: 100px 0 60px;
            height: auto;
            min-height: 100% !important;
       }



    .flexRow .col-md-6{

            height: 100%;
         

       }

    .iti
    {
        width: 100% !important;
    }

    .formCol .col-md-6
    {
           width: 100%;    
    }

    .formCol label
    {
        display: block;
    }



    .plan_wrpr.active{

            border: 1px solid #ac9b9b;

       }

       .iti__selected-flag {
            height: 38px;
        }

    .order_shipping_quotes_data input{
        width:10%;
        height: 20px;
    }
</style>

<div class="Checkout_section chepadd">

    <div class="container">

        <div class="checkout_form">

            <div class="row " >



                @if(Auth::check())

                <?php 

                    if (Auth::check()) {

                        $userId  = Auth::user()->id;

                    } 

                    $userAddresses=\App\Models\UserAddress::where('user_id',Auth::user()->id)->get();

                    $userDefaultAddress=\App\Models\UserAddress::where('user_id',Auth::user()->id)->where('use_address_as_default','yes')->first();

                ?>

                <div class="col-md-7 deskTop mb-20">

                   <div class="row">
                        <div class="col-md-6">

                        <a id="addAddressModal" class="borderBox addAddress">

                            <div class="flexHeight">

                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" class="mr6"><g fill="var(--brand-3)" fill-rule="nonzero"><path d="M8 0a1 1 0 01.993.883L9 1v14a1 1 0 01-1.993.117L7 15V1a1 1 0 011-1z"></path><path d="M15 7a1 1 0 01.117 1.993L15 9H1a1 1 0 01-.117-1.993L1 7h14z"></path></g></svg>

                              Add new address

                          </div>

                        </a>

                    </div>
                   </div>



                    <div class="row rowFlex ">

                        @if(isset($userAddresses) && sizeof($userAddresses)>0)

                            @foreach($userAddresses as $key => $userAddress)
                        
                               @if(!empty($userAddress))

                                    <div class="col-md-6 checkoutclassAddressSelected ">

                                        <input type="hidden" name="id_sub" class="sub_id"  value="{{$userAddress['id']}}">



                                        <div class="borderBox  plan_wrpr @if($userAddress['use_address_as_default']=='yes') active @endif ">

                                           <div class="business-name-with-log-wrap">

                                              <strong>{{$userAddress['name']}}</strong>

                                           </div>

                                           <div class="order-info-section mt-2">

                                              <div class="order-name-cost-detail">

                                                 <div class="mb6">

                                                    <h5 class="order-total-cost text-right">+91-{{$userAddress['mobile_number']}}</h5>

                                                 </div>

                                                 <div class="address-city-info mb6">

                                                    <p class="mb-0 ">{{$userAddress['city']}}</p>

                                                    <p class="mb-2">{{$userAddress['address']}} <span class="pin-seprator mx4"></span> {{$userAddress['pincode']}}</p>

                                                 </div>

                                              </div>

                                           </div>

                                           <div class="footerEdit">

                                              @if($userAddress['use_address_as_default']=='yes')

                                                  <span class="badg_deflt mb-4 defaultAddress">Default</span>

                                              @endif  <br>

                                              <br>

                                           </div>

                                        </div>

                                    </div>

                               @endif

                            @endforeach

                        @endif  



                        <input type="hidden" name="sub_active" value="" id="sub_active">

                        <input type="hidden" name="default" id="defaultAddressId" value="{{@$userDefaultAddress['id']}}">



                    </div>

                </div>



                @else

                    <div class="col-lg-6 col-md-6">

                            <h3>Billing Details</h3>

                                <div class="row">

                                    <form id="addFormForAddress" class="formCol">  

                                        @csrf

                                        <div class="col-md-6 mb-20">

                                            <label>Name<span>*</span></label>

                                            <input class="addformEmpty" type="text" id="add_name" name="name" value="" placeholder="Enter Name">    

                                        </div>

                                        <div class="col-md-6 mb-20">

                                            <label>Mobile Number  <span>*</span></label>

                                            <input type="tel" id="add_mobile_number" class="phone phoneClass addformEmpty" maxlength="10" required="" value="+91" name="mobile_number" />

                                            <input type="hidden" class="form-control" name="isd_code" id="isd_code1" value="91">

                                            <input type="hidden" class="form-control" name="isd_flag" id="isd_flag1" value="in">

                                         </div>



                                        <div class="col-md-6 mb-20">

                                            <label>Pincode</label>

                                            <input class="addformEmpty" type="text"  id="add_pincode" name="pincode" value="" placeholder="Enter Pincode">     

                                        </div>

                                        <div class="col-md-6 mb-20">

                                            <label for="country">City <span>*</span></label>

                                            <input type="text" class="addformEmpty" name="city" id="add_city" value="" placeholder="Enter City">  

                                        </div>
                                        
                                      <div class="col-md-6 mb-20">
                    
                                         <label for="country">Street <span>*</span></label>
                    
                                          <input type="text" class="addformEmpty" name="street" id="add_street" value="" placeholder="Enter Street">  
                    
                                      </div>
                                      
                                      <div class="col-md-6 mb-20">
                    
                                         <label for="country">Street 2</label>
                    
                                          <input type="text" class="addformEmpty" name="street2" id="add_street2" value="" placeholder="Enter Street 2">  
                    
                                      </div>  
                                      
                                        <div class="col-12 mb-10 contact_message">

                                            <label>Address  <span>*</span></label>

                                            <textarea name="address" id="add_address" value="" placeholder="Address" class="form-control2 addformEmpty"  rows="2"></textarea>     

                                        </div>
                                        
                                        <?php foreach ($storeSetting as $key => $storeSetting11): ?>
                                            <div class="col-md-6 mb-20 additionalFieldsFormData">
                                                <label>{{@$storeSetting11["field_name"]}} </label>
                                                <input @if($storeSetting11['field_type']=='date') type="text" @elseif($storeSetting11['field_type']=='text') type="text" @elseif($storeSetting11['field_type']=='time') type="time" @else type="email" @endif  @if($storeSetting11['is_required']=='yes') required='' @endif name="{{$storeSetting11['field_name']}}" @if($storeSetting11['field_type']=='date') class="form-control2 datepicker" @else class="form-control2" @endif   value="">
                                            </div>
                                            </br>
                                        <?php endforeach ?>

                                    </form>

                              </div>

                    </div>

                @endif

               <!-- // -->

                  

                <div class="col-lg-5 col-md-5 checkout-right">
                    <div class="order-loader">
                        <div class="spinner-border text-success" role="status">
                          <span class="sr-only"></span>
                        </div>
                        </div>
                    <form id="checkout_form_submit">
                        @csrf
                        <h3>Your order</h3>
                        <div class="order_table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sellerProduct as $key=>$value): ?>
                                        <?php 
                                            // dd($value['size_id']);
                                            $sellerProductColorRecord = \App\Models\SellerProductColor::where('id',$value['color_id'])->first();
                                            $sellerProductSizeRecord  = \App\Models\SellerProductSize::where('id',$value['size_id'])->first();
                                        ?>
                                    
                                    <tr>
                                        <td>{{$value['Product']['name']}} @if(isset($sellerProductSizeRecord['size'])) (Size:{{@$sellerProductSizeRecord['size']}}) @endif  @if(isset($sellerProductColorRecord['name'])) (Color:{{@$sellerProductColorRecord['name']}}) @endif <strong> × {{$value['product_quantity']}}</strong>
                                        </td>
                                        <td>$ {{$value['total_price']}}</td>
                                        <input  productId="{{$value['Product']['id']}}" value="{{$value['product_quantity']}}" class="product_quantity_checkout" type="hidden">
                                    </tr>

                                    <?php endforeach ?>

                                </tbody>

                                <tfoot>

                                    <?php

                                        $discountPriceSession = Session::get('discount_price');

                                        $discountTypeSession         =  Session::get('discount_type');

                                        //Below for flat price case only

                                        $discounted_AmountSession    =  Session::get('discounted_Amount');

                                    ?>





                                    <?php if (isset($discountPriceSession) && isset($discountTypeSession)): ?>

                                        <tr>

                                            <div class="cart_subtotal">

                                               <th><p>Discount Coupon Applied</p></th>

                                               <td>                                                   

                                                <p class="cart_amount">- $ {{ ($discountTypeSession=='flat_discount')? $discounted_AmountSession:$discounted_AmountSession}}</p>

                                               </td>

                                            </div>

                                        </tr>

                                    <?php endif ?>



                                    <tr>

                                        <th>Cart Subtotal</th>

                                        <!-- <td>$ {{$sumProductPrice}}</td> -->

                                        <td>$ {{isset($discountPriceSession)? $discountPriceSession :$sumProductPrice}}</td>

                                        <?php

                                            $sumProductPrice = isset($discountPriceSession)? $discountPriceSession :$sumProductPrice; 

                                        ?>

                                    </tr>



                                    <?php
                                            $sellerCharge = \App\Models\SellerCharge::where('seller_id',$sellerProduct['0']['Product']['seller_id'])->where('gst','active')->first();

                                            $new_grand_value = ($sellerCharge['gst_percentage'] / 100) * $sumProductPrice;

                                            $newGrandAmount = $sumProductPrice + $new_grand_value;

                                            // grandFinalAmount

                                            $sellerExtraCharge = \App\Models\SellerExtraCharge::where('seller_id',1)->get();

                                            // dd($sellerExtraCharge);
                                    ?>

                                    @if(isset($sellerCharge['gst']))

                                        @if($sellerCharge['gst']=='active')

                                        <tr>

                                            <th>GST ({{$sellerCharge['gst_percentage']}}%)</th>

                                            <td>$ {{$new_grand_value}}</td>

                                        </tr>

                                        @endif

                                    @endif



                                    @if(isset($sellerExtraCharge))

                                        <?php foreach ($sellerExtraCharge as $key => $val): ?>

                                        <tr>

                                            <th>{{$val['charge_name']}} 



                                            @if($val['charges_in_percent']) ({{ $val['charges_in_percent']}}%) @endif</th>

                                            

                                            <?php 

                                                if($val['charges_in_percent']){

                                                   $extraCharges = ($val['charges_in_percent'] / 100) * $sumProductPrice; 

                                                }else{

                                                   $extraCharges = $val['charges_in_flat_price'];

                                                }

                                                $newGrandAmount += $extraCharges; 

                                            ?>

                                            <td>$ {{$extraCharges}}</td>

                                        </tr>

                                        <?php endforeach ?>

                                    @endif



                                    <tr class="order_total">

                                        <th>Order Total</th>

                                        <td><strong>$ {{isset($newGrandAmount) ? number_format($newGrandAmount,2):number_format($sumProductPrice,2)}}</strong>

                                        </td>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>
                        <div class="order_shipping_quotes hidden">
                            <h4>Shipping Quotes</h4>
                            <div class="order_shipping_quotes_data">
                                            
                            </div>                            
                        </div>
                        <div class="payment_method">
                            <h4>Payment Method</h4>
                            <div class="panel-default">
                                <input id="payment_defult" name="check_method" type="radio" data-target="createp_account" /> 
                                <label for="payment_defult" href="#">Cash</label> 
                            </div>
                            <div class="panel-default">
                                <input id="payment_srpago" name="check_method" type="radio" value="srpago" data-target="createp_account" /> 
                                <label for="payment_srpago">Sr. Pago</label> 
                            </div>

                            <div class="order_button mt-4">

                                <button type="button" id="checkout_button_order_confirm">Confirm Order</button>

                            </div> 



                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>



<?php 

    if (Auth::check()) {

        $userId  = Auth::user()->id;

    } else{

       $userId   = @$_COOKIE['guestId'];

    }

    Session::put('tax', $new_grand_value);

    Session::put('final_price', $sumProductPrice);

    Session::put('grand_total_price', ($newGrandAmount) ? $newGrandAmount: $sumProductPrice);

?>



<input type="hidden" name="grand_total_price" id="grand_total_price" value="{{($newGrandAmount) ? $newGrandAmount: $sumProductPrice}}">



<input type="hidden" name="user_id" id="user_id" value="{{$userId}}">



<input type="hidden" name="final_price" id="final_price" value="{{$sumProductPrice}}">



<input type="hidden" name="tax" id="tax" value="{{$new_grand_value}}">



<!--Checkout page section end-->

@include('frontend.common.footer')

<script>
$(document).ready(function(){
    getShipQuotes();
});
</script>

<!-- checkout_form_submit -->

